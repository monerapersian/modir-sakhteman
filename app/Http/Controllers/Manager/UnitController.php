<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Payment;
use App\Models\Unit;
use App\Models\UnitObligation;
use App\Models\UnitOwnership;
use App\Models\UnitResidency;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Morilog\Jalali\Jalalian;
use RuntimeException;
use Throwable;
use Illuminate\View\View;

class UnitController extends Controller
{
    /**
     * نمایش، جستجو و فیلتر واحدهای ساختمان مدیر.
     */
    public function index(Request $request): View
    {
        $building = $request->user()
            ->buildings()
            ->firstOrFail();

        // دریافت ورودی‌های جستجو و فیلتر
        $search = trim((string) $request->query('search', ''));
        $occupancy = $request->query('occupancy', '');
        $financial = $request->query('financial', '');

        // جلوگیری از دریافت مقادیر نامعتبر برای فیلترها
        if (! in_array($occupancy, ['', 'occupied', 'empty'], true)) {
            $occupancy = '';
        }

        if (! in_array($financial, ['', 'paid', 'debt'], true)) {
            $financial = '';
        }

        // نرمال‌سازی ارقام فارسی و عربی برای جستجو
        $normalizedSearch = $this->normalizeDigits($search);

        // یکسان‌سازی ارقام ذخیره‌شده در نام واحد هنگام جستجو
        $unitNameExpression = 'units.unit_name';

        foreach ([
            '۰' => '0', '۱' => '1', '۲' => '2',
            '۳' => '3', '۴' => '4', '۵' => '5',
            '۶' => '6', '۷' => '7', '۸' => '8',
            '۹' => '9',
            '٠' => '0', '١' => '1', '٢' => '2',
            '٣' => '3', '٤' => '4', '٥' => '5',
            '٦' => '6', '٧' => '7', '٨' => '8',
            '٩' => '9',
        ] as $digit => $replacement) {
            $unitNameExpression = "REPLACE(
                {$unitNameExpression},
                '{$digit}',
                '{$replacement}'
            )";
        }

        /*
         * محاسبه مانده مالی کل واحد:
         * مجموع تعهدات منهای مجموع پرداخت‌های ثبت‌شده.
         */
        $debtExpression = "(
            (
                SELECT COALESCE(SUM(unit_obligations.amount), 0)
                FROM unit_obligations
                WHERE unit_obligations.unit_id = units.id
            )
            -
            (
                SELECT COALESCE(SUM(payments.amount), 0)
                FROM payments
                INNER JOIN unit_obligations AS paid_obligations
                    ON paid_obligations.id = payments.unit_obligation_id
                WHERE paid_obligations.unit_id = units.id
            )
        )";

        // پایه جستجو: فقط واحدهای ساختمان همین مدیر
        $query = $building->units()
            ->with([
                'residencies' => function ($query) {
                    $query->whereNull('ended_at')
                        ->latest('started_at');
                },
                'obligations.payments',
            ]);

        // جستجو بر اساس نام واحد یا نام ساکن فعلی
        if ($search !== '') {
            $query->where(function ($query) use (
                $search,
                $normalizedSearch,
                $unitNameExpression
            ) {
                $query->where(
                    'units.unit_name',
                    'like',
                    '%' . $search . '%'
                );

                if ($normalizedSearch !== $search) {
                    $query->orWhereRaw(
                        "{$unitNameExpression} LIKE ?",
                        ['%' . $normalizedSearch . '%']
                    );
                } else {
                    $query->orWhereRaw(
                        "{$unitNameExpression} LIKE ?",
                        ['%' . $normalizedSearch . '%']
                    );
                }

                $query->orWhereHas('residencies', function ($residencyQuery) use ($search) {
                    $residencyQuery
                        ->whereNull('ended_at')
                        ->where('name', 'like', '%' . $search . '%');
                });
            });
        }

        // فیلتر وضعیت سکونت
        if ($occupancy === 'occupied') {
            $query->where('units.occupancy_status', 'occupied');
        } elseif ($occupancy === 'empty') {
            $query->where('units.occupancy_status', 'vacant');
        }

        // فیلتر وضعیت مالی در سطح دیتابیس
        if ($financial === 'debt') {
            $query->whereRaw("{$debtExpression} > 0");
        } elseif ($financial === 'paid') {
            $query->whereRaw("{$debtExpression} <= 0");
        }

        // اعمال فیلترها قبل از صفحه‌بندی
        $units = $query
            ->orderBy('units.floor')
            ->orderBy('units.unit_name')
            ->paginate(10)
            ->withQueryString();

        // آمار کلی ساختمان، مستقل از فیلترها
        $totalUnits = (int) $building->residential_units
            + (int) $building->administrative_units
            + (int) $building->commercial_units;

        $registeredUnits = $building->units()->count();

        $unregisteredUnits = max(0, $totalUnits - $registeredUnits);

        $occupiedUnits = $building->units()
            ->where('occupancy_status', 'occupied')
            ->count();

        $vacantUnits = $building->units()
            ->where('occupancy_status', 'vacant')
            ->count();

        // محاسبه مانده مالی واحدهای صفحه جاری برای نمایش در کارت‌ها
        foreach ($units as $unit) {
            $totalDebt = (int) $unit->obligations->sum('amount');

            $totalPaid = (int) $unit->obligations->sum(
                function ($obligation) {
                    return $obligation->payments->sum('amount');
                }
            );

            $unit->total_debt = $totalDebt;
            $unit->total_paid = $totalPaid;

            $unit->remaining_debt = max(
                0,
                $totalDebt - $totalPaid
            );

            $unit->financial_status = $unit->remaining_debt > 0
                ? 'debt'
                : 'paid';
        }

        return view('manager.units.index', compact(
            'building',
            'units',
            'totalUnits',
            'registeredUnits',
            'unregisteredUnits',
            'occupiedUnits',
            'vacantUnits',
            'search',
            'occupancy',
            'financial'
        ));
    }

    /**
     * نمایش فرم ثبت واحد جدید.
     */
    public function create(Request $request): View
    {
        $building = $request->user()
            ->buildings()
            ->first();

        return view('manager.units.create', compact('building'));
    }

    /**
     * تبدیل ارقام فارسی و عربی به انگلیسی.
     */
    private function normalizeDigits(?string $value): string
    {
        return strtr(trim((string) $value), [
            '۰' => '0', '۱' => '1', '۲' => '2',
            '۳' => '3', '۴' => '4', '۵' => '5',
            '۶' => '6', '۷' => '7', '۸' => '8',
            '۹' => '9',
            '٠' => '0', '١' => '1', '٢' => '2',
            '٣' => '3', '٤' => '4', '٥' => '5',
            '٦' => '6', '٧' => '7', '٨' => '8',
            '٩' => '9',
        ]);
    }

    /**
     * تبدیل تاریخ جلالی فرم به تاریخ میلادی مناسب دیتابیس.
     */
    private function jalaliToGregorian(?string $date): ?string
    {
        if (empty($date)) {
            return null;
        }

        $date = $this->normalizeDigits($date);
        $parts = explode('-', $date);

        if (count($parts) !== 3) {
            throw new RuntimeException('Invalid Jalali date.');
        }

        $year = (int) $parts[0];
        $month = (int) $parts[1];
        $day = (int) $parts[2];

        $jalali = Jalalian::fromFormat(
            'Y/m/d',
            sprintf('%04d/%02d/%02d', $year, $month, $day)
        );

        if (
            $jalali->getYear() !== $year
            || $jalali->getMonth() !== $month
            || $jalali->getDay() !== $day
        ) {
            throw new RuntimeException('Invalid Jalali date.');
        }

        return $jalali->toCarbon()->toDateString();
    }

    /**
     * تبدیل مبلغ واردشده به عدد انگلیسی بدون جداکننده.
     */
    private function normalizeAmount(?string $amount): ?int
    {
        if ($amount === null || trim($amount) === '') {
            return null;
        }

        $amount = $this->normalizeDigits($amount);
        $amount = str_replace([',', '٬', ' '], '', $amount);

        if ($amount === '' || ! ctype_digit($amount)) {
            return null;
        }

        return (int) $amount;
    }

    /**
     * ثبت واحد جدید.
     */
    public function store(Request $request): RedirectResponse
    {
        $building = $request->user()
            ->buildings()
            ->firstOrFail();

        $request->merge([
            'resident_debt_amount' => $this->normalizeDigits(
                $request->input('resident_debt_amount')
            ),
            'owner_debt_amount' => $this->normalizeDigits(
                $request->input('owner_debt_amount')
            ),
            'resident_move_in_date' => $this->normalizeDigits(
                $request->input('resident_move_in_date')
            ),
            'ownership_start_date' => $this->normalizeDigits(
                $request->input('ownership_start_date')
            ),
        ]);

        $validated = $request->validate([
            'unit_name' => ['required', 'string', 'max:24'],
            'floor' => ['required', 'integer', 'min:0', 'max:99'],
            'unit_type' => [
                'required',
                'in:residential,administrative,commercial',
            ],
            'area' => ['nullable', 'integer', 'min:0', 'max:999'],
            'parking' => ['nullable', 'string', 'max:5'],
            'storage' => ['required', 'boolean'],
            'occupancy_status' => ['required', 'in:occupied,vacant'],
            'description' => ['nullable', 'string'],

            'resident_name' => ['nullable', 'string', 'max:255'],
            'resident_phone' => ['nullable', 'regex:/^0[0-9]{10}$/'],
            'resident_count' => ['nullable', 'integer', 'min:1', 'max:99'],
            'residency_type' => ['nullable', 'in:owner,tenant'],
            'resident_move_in_date' => ['nullable', 'date_format:Y-m-d'],
            'resident_description' => ['nullable', 'string', 'max:460'],
            'resident_debt_title' => ['nullable', 'string', 'max:210'],
            'resident_debt_amount' => ['nullable', 'string'],

            'owner_name' => ['nullable', 'string', 'max:255'],
            'owner_phone' => ['nullable', 'regex:/^0[0-9]{10}$/'],
            'ownership_start_date' => ['nullable', 'date_format:Y-m-d'],
            'owner_description' => ['nullable', 'string', 'max:460'],
            'owner_debt_title' => ['nullable', 'string', 'max:210'],
            'owner_debt_amount' => ['nullable', 'string'],
        ]);

        $capacity = match ($validated['unit_type']) {
            'residential' => (int) $building->residential_units,
            'administrative' => (int) $building->administrative_units,
            'commercial' => (int) $building->commercial_units,
        };

        $registeredOfType = $building->units()
            ->where('unit_type', $validated['unit_type'])
            ->count();

        if ($registeredOfType >= $capacity) {
            return back()
                ->withErrors([
                    'unit_type' => 'ظرفیت ثبت واحدهای این نوع در ساختمان تکمیل شده است.',
                ])
                ->withInput();
        }

        try {
            $residentMoveInDate = $this->jalaliToGregorian(
                $validated['resident_move_in_date'] ?? null
            );

            $ownershipStartDate = $this->jalaliToGregorian(
                $validated['ownership_start_date'] ?? null
            );
        } catch (Throwable $exception) {
            return back()
                ->withErrors([
                    'resident_move_in_date' => 'تاریخ واردشده معتبر نیست.',
                ])
                ->withInput();
        }

        $residentDebtAmount = $this->normalizeAmount(
            $validated['resident_debt_amount'] ?? null
        );

        $ownerDebtAmount = $this->normalizeAmount(
            $validated['owner_debt_amount'] ?? null
        );

        DB::transaction(function () use (
            $building,
            $validated,
            $residentMoveInDate,
            $ownershipStartDate,
            $residentDebtAmount,
            $ownerDebtAmount
        ) {
            $unit = Unit::create([
                'building_id' => $building->id,
                'unit_name' => $validated['unit_name'],
                'floor' => $validated['floor'],
                'unit_type' => $validated['unit_type'],
                'area' => $validated['area'] ?? null,
                'parking' => $validated['parking'] ?? null,
                'storage' => $validated['storage'],
                'occupancy_status' => $validated['occupancy_status'],
            ]);

            if (
                $validated['occupancy_status'] === 'occupied'
                && ! empty($validated['resident_name'])
            ) {
                UnitResidency::create([
                    'unit_id' => $unit->id,
                    'name' => $validated['resident_name'],
                    'phone' => $validated['resident_phone'] ?? null,
                    'resident_count' => $validated['resident_count'] ?? null,
                    'resident_type' => $validated['residency_type'] ?? 'tenant',
                    'started_at' => $residentMoveInDate,
                    'ended_at' => null,
                    'notes' => $validated['resident_description'] ?? null,
                ]);
            }

            if (! empty($validated['owner_name'])) {
                UnitOwnership::create([
                    'unit_id' => $unit->id,
                    'name' => $validated['owner_name'],
                    'phone' => $validated['owner_phone'] ?? null,
                    'started_at' => $ownershipStartDate,
                    'ended_at' => null,
                    'notes' => $validated['owner_description'] ?? null,
                ]);
            }

            if (
                ! empty($validated['resident_debt_title'])
                && $residentDebtAmount !== null
                && $residentDebtAmount > 0
            ) {
                UnitObligation::create([
                    'unit_id' => $unit->id,
                    'charge_period_id' => null,
                    'building_expense_id' => null,
                    'type' => 'previous_debt',
                    'title' => $validated['resident_debt_title'],
                    'amount' => $residentDebtAmount,
                    'responsible_party' => 'resident',
                    'due_date' => null,
                    'description' => null,
                ]);
            }

            if (
                ! empty($validated['owner_debt_title'])
                && $ownerDebtAmount !== null
                && $ownerDebtAmount > 0
            ) {
                UnitObligation::create([
                    'unit_id' => $unit->id,
                    'charge_period_id' => null,
                    'building_expense_id' => null,
                    'type' => 'previous_debt',
                    'title' => $validated['owner_debt_title'],
                    'amount' => $ownerDebtAmount,
                    'responsible_party' => 'owner',
                    'due_date' => null,
                    'description' => null,
                ]);
            }
        });

        return redirect()
            ->route('manager.units')
            ->with('success', 'واحد با موفقیت ثبت شد.');
    }

    /**
     * نمایش پروفایل یک واحد.
     */
    public function show(Request $request, Unit $unit): View
    {
        $building = $request->user()
            ->buildings()
            ->firstOrFail();

        $unit = $building->units()
            ->whereKey($unit->id)
            ->with([
                'ownerships' => function ($query) {
                    $query->whereNull('ended_at')
                        ->latest('started_at');
                },
                'residencies' => function ($query) {
                    $query->whereNull('ended_at')
                        ->latest('started_at');
                },
                'obligations.payments',
            ])
            ->firstOrFail();

        return view('manager.units.show', compact(
            'building',
            'unit'
        ));
    }

    /**
     * ثبت پرداخت بخشی یا کامل بدهی در پروفایل واحد.
     */
    public function storePayment(
        Request $request,
        Unit $unit,
        UnitObligation $obligation
    ): RedirectResponse {
        $building = $request->user()
            ->buildings()
            ->firstOrFail();

        // اطمینان از تعلق واحد به ساختمان مدیر.
        $unit = $building->units()
            ->whereKey($unit->id)
            ->firstOrFail();

        // اطمینان از تعلق بدهی به همان واحد.
        abort_unless(
            (int) $obligation->unit_id === (int) $unit->id,
            404
        );

        $request->merge([
            'amount' => str_replace(
                [',', '٬', ' '],
                '',
                $this->normalizeDigits($request->input('amount'))
            ),
            'paid_at' => $this->normalizeDigits(
                $request->input('paid_at')
            ),
        ]);

        $validated = $request->validate([
            'amount' => [
                'required',
                'regex:/^[0-9]+$/',
                'integer',
                'min:1000',
            ],
            'paid_at' => [
                'required',
                'regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
            ],
            'description' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ], [
            'amount.required' => 'مبلغ پرداخت را وارد کنید.',
            'amount.regex' => 'مبلغ پرداخت باید عدد معتبر باشد.',
            'amount.integer' => 'مبلغ پرداخت باید عدد صحیح باشد.',
            'amount.min' => 'حداقل مبلغ پرداخت ۱۰۰۰ تومان است.',
            'paid_at.required' => 'تاریخ پرداخت را انتخاب کنید.',
            'paid_at.regex' => 'تاریخ پرداخت معتبر نیست.',
            'description.max' => 'توضیحات نمی‌تواند بیشتر از ۲۰۰۰ کاراکتر باشد.',
        ]);

        try {
            $paidAt = $this->jalaliToGregorian($validated['paid_at']);
        } catch (Throwable $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'paid_at' => 'تاریخ پرداخت معتبر نیست.',
                ]);
        }

        try {
            DB::transaction(function () use (
                $request,
                $validated,
                $obligation,
                $paidAt
            ) {
                $lockedObligation = UnitObligation::query()
                    ->whereKey($obligation->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $totalPaid = (int) $lockedObligation
                    ->payments()
                    ->sum('amount');

                $remaining = (int) $lockedObligation->amount
                    - $totalPaid;

                if ($remaining <= 0) {
                    throw new RuntimeException(
                        'OBLIGATION_ALREADY_PAID'
                    );
                }

                if ((int) $validated['amount'] > $remaining) {
                    throw new RuntimeException(
                        'PAYMENT_EXCEEDS_REMAINING'
                    );
                }

                Payment::create([
                    'unit_obligation_id' => $lockedObligation->id,
                    'created_by' => $request->user()->id,
                    'amount' => (int) $validated['amount'],
                    'paid_at' => $paidAt,
                    'description' => $validated['description'] ?? null,
                ]);
            });
        } catch (Throwable $exception) {
            if (in_array($exception->getMessage(), [
                'OBLIGATION_ALREADY_PAID',
                'PAYMENT_EXCEEDS_REMAINING',
            ], true)) {
                return back()
                    ->withInput()
                    ->with('error', $exception->getMessage()
                        === 'OBLIGATION_ALREADY_PAID'
                        ? 'این بدهی قبلاً تسویه شده است.'
                        : 'مبلغ پرداخت نمی‌تواند بیشتر از مانده بدهی باشد.');
            }

            report($exception);

            return back()
                ->withInput()
                ->with('error', 'ثبت پرداخت انجام نشد. دوباره تلاش کنید.');
        }

        return redirect()
            ->route('manager.units.show', $unit->id)
            ->with('success', 'پرداخت با موفقیت ثبت شد.');
    }
}