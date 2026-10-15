<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\ChargePeriod;
use App\Models\Payment;
use App\Models\UnitObligation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Morilog\Jalali\Jalalian;
use RuntimeException;
use Throwable;

class ChargeController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $building = $request->user()
            ->buildings()
            ->with('units')
            ->first();

        if (!$building) {
            return redirect()
                ->route('home')
                ->with('error', 'ساختمان شما پیدا نشد.');
        }

        $chargePeriods = $building->chargePeriods()
            ->with([
                'obligations.unit',
                'obligations.payments',
            ])
            ->withCount('obligations')
            ->orderByDesc('starts_at')
            ->get();

        return view('manager.charges', compact(
            'building',
            'chargePeriods'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $building = $this->getBuilding($request);

        if (!$building) {
            return redirect()
                ->route('home')
                ->with('error', 'ساختمان شما پیدا نشد.');
        }

        $normalizeAmount = static function ($value): string {
            $value = strtr((string) $value, [
                '۰' => '0', '۱' => '1', '۲' => '2',
                '۳' => '3', '۴' => '4', '۵' => '5',
                '۶' => '6', '۷' => '7', '۸' => '8',
                '۹' => '9',
                '٠' => '0', '١' => '1', '٢' => '2',
                '٣' => '3', '٤' => '4', '٥' => '5',
                '٦' => '6', '٧' => '7', '٨' => '8',
                '٩' => '9',
            ]);

            return str_replace([',', '٬', ' '], '', $value);
        };

        $request->merge([
            'occupied_charge' => $normalizeAmount(
                $request->input('occupied_charge')
            ),
            'vacant_charge' => $normalizeAmount(
                $request->input('vacant_charge')
            ),
        ]);

        $validated = $request->validate([
            'occupied_charge' => [
                'required',
                'string',
                'regex:/^[1-9][0-9]{3,8}$/',
            ],
            'vacant_charge' => [
                'required',
                'string',
                'regex:/^[1-9][0-9]{3,8}$/',
            ],
        ], [
            'occupied_charge.required' =>
                'مبلغ شارژ واحدهای دارای ساکن را وارد کنید.',
            'occupied_charge.regex' =>
                'مبلغ شارژ باید بین ۴ تا ۹ رقم باشد.',
            'vacant_charge.required' =>
                'مبلغ شارژ واحدهای بدون ساکن را وارد کنید.',
            'vacant_charge.regex' =>
                'مبلغ شارژ باید بین ۴ تا ۹ رقم باشد.',
        ]);

        $building->update([
            'occupied_monthly_charge' =>
                (int) $validated['occupied_charge'],
            'vacant_monthly_charge' =>
                (int) $validated['vacant_charge'],
        ]);

        return redirect()
            ->route('manager.charges')
            ->with(
                'success',
                'مبلغ شارژ ثابت ماهیانه با موفقیت ثبت شد.'
            );
    }

    public function issue(Request $request): RedirectResponse
    {
        $building = $this->getBuilding($request);

        if (!$building) {
            return redirect()
                ->route('home')
                ->with('error', 'ساختمان شما پیدا نشد.');
        }

        $validated = $request->validate([
            'year' => ['required', 'integer', 'min:1300', 'max:1500'],
            'month' => ['required', 'integer', 'min:1', 'max:12'],
        ], [
            'year.required' => 'سال دوره را انتخاب کنید.',
            'year.integer' => 'سال انتخاب‌شده معتبر نیست.',
            'month.required' => 'ماه دوره را انتخاب کنید.',
            'month.integer' => 'ماه انتخاب‌شده معتبر نیست.',
            'month.min' => 'ماه انتخاب‌شده معتبر نیست.',
            'month.max' => 'ماه انتخاب‌شده معتبر نیست.',
        ]);

        $units = $building->units()->get();

        if ($units->isEmpty()) {
            return back()->withInput()->with(
                'error',
                'ابتدا واحدهای ساختمان را ثبت کنید.'
            );
        }

        $occupiedUnits = $units->where('occupancy_status', 'occupied');
        $vacantUnits = $units->where('occupancy_status', 'vacant');

        if (
            $occupiedUnits->isNotEmpty()
            && (int) $building->occupied_monthly_charge <= 0
        ) {
            return back()->withInput()->with(
                'error',
                'ابتدا مبلغ شارژ واحدهای دارای ساکن را تعیین کنید.'
            );
        }

        if (
            $vacantUnits->isNotEmpty()
            && (int) $building->vacant_monthly_charge <= 0
        ) {
            return back()->withInput()->with(
                'error',
                'ابتدا مبلغ شارژ واحدهای بدون ساکن را تعیین کنید.'
            );
        }

        $monthNames = [
            1 => 'فروردین',
            2 => 'اردیبهشت',
            3 => 'خرداد',
            4 => 'تیر',
            5 => 'مرداد',
            6 => 'شهریور',
            7 => 'مهر',
            8 => 'آبان',
            9 => 'آذر',
            10 => 'دی',
            11 => 'بهمن',
            12 => 'اسفند',
        ];

        $year = (int) $validated['year'];
        $month = (int) $validated['month'];

        $periodTitle = sprintf(
            'شارژ ماهانه %s %d',
            $monthNames[$month],
            $year
        );

        try {
            $jalaliPeriod = Jalalian::fromFormat(
                'Y/m/d',
                sprintf('%04d/%02d/01', $year, $month)
            );

            $startDate = $jalaliPeriod->toCarbon()->startOfDay();

            $nextYear = $month === 12 ? $year + 1 : $year;
            $nextMonth = $month === 12 ? 1 : $month + 1;

            $nextJalaliPeriod = Jalalian::fromFormat(
                'Y/m/d',
                sprintf('%04d/%02d/01', $nextYear, $nextMonth)
            );

            $nextMonthStart = $nextJalaliPeriod
                ->toCarbon()
                ->startOfDay();

            $endDate = $nextMonthStart->copy()
                ->subDay()
                ->startOfDay();
        } catch (Throwable $exception) {
            report($exception);

            return back()->withInput()->with(
                'error',
                'دوره انتخاب‌شده معتبر نیست.'
            );
        }

        $startDateString = $startDate->toDateString();
        $endDateString = $endDate->toDateString();

        $alreadyIssued = ChargePeriod::where(
            'building_id',
            $building->id
        )
            ->whereDate('starts_at', $startDateString)
            ->whereDate('ends_at', $endDateString)
            ->exists();

        if ($alreadyIssued) {
            return back()->withInput()->with(
                'error',
                'شارژ این دوره قبلاً صادر شده است.'
            );
        }

        try {
            DB::transaction(function () use (
                $building,
                $units,
                $startDateString,
                $endDateString,
                $periodTitle
            ) {
                $period = $building->chargePeriods()->create([
                    'title' => $periodTitle,
                    'starts_at' => $startDateString,
                    'ends_at' => $endDateString,
                    'occupied_amount' =>
                        (int) $building->occupied_monthly_charge,
                    'vacant_amount' =>
                        (int) $building->vacant_monthly_charge,
                ]);

                $obligations = [];

                foreach ($units as $unit) {
                    $isOccupied =
                        $unit->occupancy_status === 'occupied';

                    $amount = $isOccupied
                        ? (int) $building->occupied_monthly_charge
                        : (int) $building->vacant_monthly_charge;

                    $obligations[] = [
                        'unit_id' => $unit->id,
                        'type' => 'charge',
                        'title' => $periodTitle,
                        'amount' => $amount,
                        'responsible_party' => $isOccupied
                            ? 'resident'
                            : 'owner',
                        'due_date' => null,
                        'description' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                $period->obligations()->createMany($obligations);
            });
        } catch (Throwable $exception) {
            report($exception);

            return back()->withInput()->with(
                'error',
                'صدور شارژ انجام نشد. اطلاعات ذخیره نشد؛ دوباره تلاش کنید.'
            );
        }

        return redirect()
            ->route('manager.charges')
            ->with(
                'success',
                sprintf(
                    'شارژ %s با موفقیت برای %d واحد صادر شد.',
                    $periodTitle,
                    $units->count()
                )
            );
    }

    public function storePayment(Request $request): RedirectResponse
    {
        $building = $this->getBuilding($request);

        if (!$building) {
            return redirect()
                ->route('home')
                ->with('error', 'ساختمان شما پیدا نشد.');
        }

        $normalizeDigits = static function ($value): string {
            return strtr(trim((string) $value), [
                '۰' => '0', '۱' => '1', '۲' => '2',
                '۳' => '3', '۴' => '4', '۵' => '5',
                '۶' => '6', '۷' => '7', '۸' => '8',
                '۹' => '9',
                '٠' => '0', '١' => '1', '٢' => '2',
                '٣' => '3', '٤' => '4', '٥' => '5',
                '٦' => '6', '٧' => '7',
                '٨' => '8', '٩' => '9',
            ]);
        };

        $request->merge([
            'unit_name' => trim((string) $request->input('unit_name')),
            'paid_at' => $normalizeDigits($request->input('paid_at')),
        ]);

        $validated = $request->validate([
            'unit_name' => ['required', 'string', 'max:100'],
            'charge_period_id' => [
                'required',
                'integer',
                'min:1',
            ],
            'paid_at' => [
                'required',
                'regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
            ],
            'receipt' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
            'description' => ['nullable', 'string', 'max:2000'],
        ], [
            'unit_name.required' => 'نام واحد را وارد کنید.',
            'charge_period_id.required' => 'دوره شارژ را انتخاب کنید.',
            'paid_at.required' => 'تاریخ پرداخت را انتخاب کنید.',
            'paid_at.regex' => 'تاریخ پرداخت معتبر نیست.',
            'receipt.image' => 'فایل رسید باید تصویر باشد.',
            'receipt.mimes' => 'فرمت رسید باید JPG، PNG یا WEBP باشد.',
            'receipt.max' => 'حجم تصویر رسید نباید بیشتر از ۵ مگابایت باشد.',
        ]);

        $unit = $building->units()
            ->where('unit_name', $validated['unit_name'])
            ->first();

        if (!$unit) {
            return back()
                ->withInput()
                ->withErrors([
                    'unit_name' => 'واحد مورد نظر یافت نشد.',
                ]);
        }

        $period = $building->chargePeriods()
            ->whereKey($validated['charge_period_id'])
            ->first();

        if (!$period) {
            return back()->withInput()->with(
                'error',
                'دوره شارژ انتخاب‌شده متعلق به ساختمان شما نیست.'
            );
        }

        try {
            $dateParts = explode('-', $validated['paid_at']);

            $jalaliDate = Jalalian::fromFormat(
                'Y/m/d',
                sprintf(
                    '%04d/%02d/%02d',
                    (int) $dateParts[0],
                    (int) $dateParts[1],
                    (int) $dateParts[2]
                )
            );

            if (
                $jalaliDate->getYear() !== (int) $dateParts[0]
                || $jalaliDate->getMonth() !== (int) $dateParts[1]
                || $jalaliDate->getDay() !== (int) $dateParts[2]
            ) {
                throw new RuntimeException('Invalid Jalali date.');
            }

            $paidAt = $jalaliDate->toCarbon()->toDateString();
        } catch (Throwable $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'paid_at' => 'تاریخ پرداخت معتبر نیست.',
                ]);
        }

        $obligation = UnitObligation::query()
            ->where('unit_id', $unit->id)
            ->where('charge_period_id', $period->id)
            ->where('type', 'charge')
            ->first();

        if (!$obligation) {
            return back()->withInput()->with(
                'error',
                'برای این واحد در دوره انتخاب‌شده، بدهی شارژی ثبت نشده است.'
            );
        }

        $receiptPath = null;

        try {
            DB::transaction(function () use (
                $request,
                $validated,
                $obligation,
                $paidAt,
                &$receiptPath
            ) {
                $lockedObligation = UnitObligation::query()
                    ->whereKey($obligation->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $paidAmount = (int) $lockedObligation
                    ->payments()
                    ->sum('amount');

                $remainingAmount =
                    (int) $lockedObligation->amount - $paidAmount;

                if ($remainingAmount <= 0) {
                    throw new RuntimeException('CHARGE_ALREADY_PAID');
                }

                if ($request->hasFile('receipt')) {
                    $receiptPath = $request->file('receipt')
                        ->store('payment-receipts', 'local');
                }

                Payment::create([
                    'unit_obligation_id' => $lockedObligation->id,
                    'created_by' => $request->user()->id,
                    'amount' => $remainingAmount,
                    'paid_at' => $paidAt,
                    'description' => $validated['description'] ?? null,
                    'receipt_path' => $receiptPath,
                ]);
            });
        } catch (Throwable $exception) {
            if ($receiptPath) {
                Storage::disk('local')->delete($receiptPath);
            }

            if ($exception->getMessage() === 'CHARGE_ALREADY_PAID') {
                return back()->withInput()->with(
                    'error',
                    'شارژ این واحد قبلاً به‌طور کامل پرداخت شده است.'
                );
            }

            report($exception);

            return back()->withInput()->with(
                'error',
                'ثبت پرداخت انجام نشد. اطلاعات ذخیره نشد؛ دوباره تلاش کنید.'
            );
        }

        return redirect()
            ->route('manager.charges')
            ->with(
                'success',
                'پرداخت شارژ واحد با موفقیت ثبت شد.'
            );
    }

    private function getBuilding(Request $request): ?Building
    {
        return Building::where(
            'manager_id',
            $request->user()->id
        )->first();
    }
}