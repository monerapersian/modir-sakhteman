<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\BuildingExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Morilog\Jalali\Jalalian;
use Throwable;
use App\Models\Unit;
use App\Models\UnitObligation;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BillsController extends Controller
{
    /**
     * نمایش صفحه قبوض و هزینه‌های خدماتی.
     */
    public function index(Request $request)
    {
        $building = $request->user()
            ->buildings()
            ->first();

        $currentPeriod = toPersianDigits(
            Jalalian::now()->format('%B %Y')
        );

        if ($request->query('report') === 'chart') {
            return $this->chartReport($request, $building);
        }

        /*
        |--------------------------------------------------------------------------
        | خلاصه مالی بالای صفحه
        |--------------------------------------------------------------------------
        */

        $period = $request->query('period', 'month');

        if (!in_array($period, ['month', '3months', '6months', 'year'], true)) {
            $period = 'month';
        }

        $startDate = match ($period) {
            '3months' => now()->startOfMonth()->subMonths(2),
            '6months' => now()->startOfMonth()->subMonths(5),
            'year' => now()->startOfMonth()->subMonths(11),
            default => now()->startOfMonth(),
        };

        $endDate = now()->endOfMonth();

        $summaryExpenses = $building
            ? $building->expenses()
                ->whereBetween('date', [
                    $startDate->toDateString(),
                    $endDate->toDateString(),
                ])
                ->get(['type', 'amount', 'payment_status'])
            : collect();

        // مجموع همه هزینه‌ها
        $totalExpenses = $summaryExpenses->sum('amount');

        // مجموع قبض‌های آب، برق و گاز
        $totalBills = $summaryExpenses
            ->where('type', 'bill')
            ->sum('amount');

        // مجموع هزینه‌های خدماتی
        $totalServiceExpenses = $summaryExpenses
            ->where('type', 'service')
            ->sum('amount');

        // هزینه‌هایی که وضعیت پرداخت آن‌ها پرداخت‌نشده است
        $unpaidExpenses = $summaryExpenses
            ->where('payment_status', 'unpaid');

        // مجموع مبلغ پرداخت‌نشده
        $totalUnpaidExpenses = $unpaidExpenses->sum('amount');

        // تعداد قبض‌ها و هزینه‌های پرداخت‌نشده
        $unpaidExpensesCount = $unpaidExpenses->count();

        /*
        |--------------------------------------------------------------------------
        | پاسخ AJAX برای تغییر بازه زمانی
        |--------------------------------------------------------------------------
        */

        if ($request->ajax()) {
            return response()->json([
                'totalExpenses' => $totalExpenses,
                'totalBills' => $totalBills,
                'totalServiceExpenses' => $totalServiceExpenses,
                'totalUnpaidExpenses' => $totalUnpaidExpenses,
                'unpaidExpensesCount' => $unpaidExpensesCount,
                'period' => $period,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | فیلترها و جست‌وجوی لیست هزینه‌ها
        |--------------------------------------------------------------------------
        */

        $search = trim((string) $request->query('search', ''));

        $category = (string) $request->query('category', 'all');

        $validCategories = [
            'all',
            'bills',
            'water',
            'electricity',
            'gas',
            'services',
        ];

        if (!in_array($category, $validCategories, true)) {
            $category = 'all';
        }

        $paymentStatus = (string) $request->query(
            'payment_status',
            'all'
        );

        if (!in_array($paymentStatus, ['all', 'paid', 'unpaid'], true)) {
            $paymentStatus = 'all';
        }

        $sort = (string) $request->query('sort', 'newest');

        if (!in_array(
            $sort,
            ['newest', 'oldest', 'highest', 'lowest'],
            true
        )) {
            $sort = 'newest';
        }

        $expenseQuery = $building
            ? $building->expenses()
            : BuildingExpense::query()->whereRaw('1 = 0');

        // جست‌وجو
        if ($search !== '') {
            $expenseQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // فیلتر دسته‌بندی
        switch ($category) {
            case 'bills':
                $expenseQuery->where('type', 'bill');
                break;

            case 'water':
            case 'electricity':
            case 'gas':
                $expenseQuery
                    ->where('type', 'bill')
                    ->where('category', $category);
                break;

            case 'services':
                $expenseQuery->where('type', 'service');
                break;
        }

        /*
         * وضعیت پرداخت خود قبض یا هزینه؛
         * مستقل از تسویه سهم واحدها.
         */
        if ($paymentStatus !== 'all') {
            $expenseQuery->where('payment_status', $paymentStatus);
        }

        // مرتب‌سازی
        switch ($sort) {
            case 'oldest':
                $expenseQuery
                    ->orderBy('date')
                    ->orderBy('id');
                break;

            case 'highest':
                $expenseQuery
                    ->orderByDesc('amount')
                    ->orderByDesc('date')
                    ->orderByDesc('id');
                break;

            case 'lowest':
                $expenseQuery
                    ->orderBy('amount')
                    ->orderByDesc('date')
                    ->orderByDesc('id');
                break;

            default:
                $expenseQuery
                    ->orderByDesc('date')
                    ->orderByDesc('id');
                break;
        }

        /*
        |--------------------------------------------------------------------------
        | دریافت هزینه‌ها و اطلاعات تسویه واحدها
        |--------------------------------------------------------------------------
        */

        $expenses = $expenseQuery
            ->with(['obligations.payments'])
            ->paginate(10)
            ->withQueryString();

        $expenses->getCollection()->each(function ($expense) {
            $obligations = $expense->obligations;

            $totalObligation = (int) $obligations->sum('amount');

            $totalPaid = (int) $obligations->sum(
                fn ($obligation) => $obligation->payments->sum('amount')
            );

            $expense->setAttribute(
                'total_obligation_amount',
                $totalObligation
            );

            $expense->setAttribute(
                'total_paid_amount',
                $totalPaid
            );
        });

        /*
        |--------------------------------------------------------------------------
        | نمایش صفحه
        |--------------------------------------------------------------------------
        */

        return view('manager.bills', compact(
            'building',
            'currentPeriod',
            'period',
            'totalExpenses',
            'totalBills',
            'totalServiceExpenses',
            'totalUnpaidExpenses',
            'unpaidExpensesCount',
            'expenses',
            'search',
            'category',
            'paymentStatus',
            'sort'
        ));
    }

    /**
     * دریافت اطلاعات واقعی نمودار.
     */
    private function chartReport(Request $request, $building)
    {
        $startJalali = $this->normalizeDigits(
            (string) $request->query('start_date', '')
        );

        $endJalali = $this->normalizeDigits(
            (string) $request->query('end_date', '')
        );

        if ($startJalali === '' || $endJalali === '') {
            return response()->json([
                'message' => 'لطفاً تاریخ شروع و پایان گزارش را انتخاب کنید.',
            ], 422);
        }

        try {
            $startGregorian = $this->jalaliToGregorian($startJalali);
            $endGregorian = $this->jalaliToGregorian($endJalali);
        } catch (Throwable $exception) {
            return response()->json([
                'message' => 'تاریخ شروع یا پایان معتبر نیست.',
            ], 422);
        }

        if ($startGregorian > $endGregorian) {
            return response()->json([
                'message' => 'تاریخ شروع نمی‌تواند بعد از تاریخ پایان باشد.',
            ], 422);
        }

        $start = Carbon::parse($startGregorian)->startOfDay();
        $end = Carbon::parse($endGregorian)->endOfDay();

        $categories = [
            'water' => [
                'label' => 'قبض آب',
                'color' => '#2563EB',
                'total' => 0,
            ],
            'electricity' => [
                'label' => 'قبض برق',
                'color' => '#F59E0B',
                'total' => 0,
            ],
            'gas' => [
                'label' => 'قبض گاز',
                'color' => '#16A34A',
                'total' => 0,
            ],
            'services' => [
                'label' => 'هزینه‌های خدماتی',
                'color' => '#7C3AED',
                'total' => 0,
            ],
        ];

        $labelsByMonth = [];
        $cursor = $start->copy();

        while ($cursor->lte($end)) {
            $jalali = Jalalian::fromCarbon($cursor);
            $monthKey = $jalali->format('Y/m');

            if (!isset($labelsByMonth[$monthKey])) {
                $labelsByMonth[$monthKey] = $jalali->format('%B %Y');
            }

            $cursor->addDay();
        }

        $monthlyData = [];

        foreach ($categories as $categoryKey => $categoryItem) {
            $monthlyData[$categoryKey] = [];

            foreach ($labelsByMonth as $monthKey => $label) {
                $monthlyData[$categoryKey][$monthKey] = 0;
            }
        }

        $expenses = $building
            ? $building->expenses()
                ->whereBetween('date', [
                    $start->toDateString(),
                    $end->toDateString(),
                ])
                ->get([
                    'type',
                    'category',
                    'amount',
                    'date',
                ])
            : collect();

        foreach ($expenses as $expense) {
            $categoryKey = null;

            if ($expense->type === 'bill') {
                if (in_array(
                    $expense->category,
                    ['water', 'electricity', 'gas'],
                    true
                )) {
                    $categoryKey = $expense->category;
                }
            } elseif ($expense->type === 'service') {
                $categoryKey = 'services';
            }

            if ($categoryKey === null) {
                continue;
            }

            $jalali = Jalalian::fromCarbon(
                Carbon::parse($expense->date)
            );

            $monthKey = $jalali->format('Y/m');
            $amount = (int) $expense->amount;

            if (!isset($monthlyData[$categoryKey][$monthKey])) {
                $monthlyData[$categoryKey][$monthKey] = 0;
            }

            $monthlyData[$categoryKey][$monthKey] += $amount;
            $categories[$categoryKey]['total'] += $amount;
        }

        $labels = array_values($labelsByMonth);
        $datasets = [];

        foreach ($categories as $categoryKey => $categoryItem) {
            $datasets[] = [
                'id' => $categoryKey,
                'label' => $categoryItem['label'],
                'color' => $categoryItem['color'],
                'data' => array_values(
                    $monthlyData[$categoryKey]
                ),
            ];
        }

        $totals = [];

        foreach ($categories as $categoryKey => $categoryItem) {
            $totals[$categoryKey] = $categoryItem['total'];
        }

        return response()->json([
            'labels' => $labels,
            'datasets' => $datasets,
            'totals' => $totals,
            'range' => [
                'start' => $startJalali,
                'end' => $endJalali,
            ],
        ]);
    }

    /**
     * نمایش جزئیات یک قبض یا هزینه خدماتی.
     */
    public function show(Request $request, int $expense)
    {
        $record = $this->findManagerExpense($request, $expense);

        return response()->json([
            'expense' => $this->formatExpenseForModal($record),
            'has_obligations' => $record->obligations()->exists(),
        ]);
    }

    /**
     * ویرایش قبض یا هزینه خدماتی.
     */
    public function update(Request $request, int $expense)
    {
        $record = $this->findManagerExpense($request, $expense);

        $request->merge([
            'amount' => $this->normalizeDigits(
                str_replace(
                    [',', '٬', ' '],
                    '',
                    (string) $request->input('amount')
                )
            ),
            'date' => $this->normalizeDigits(
                (string) $request->input('date')
            ),
        ]);

        $rules = [
            'amount' => 'required|integer|min:1',
            'date' => 'required|string',
            'payment_status' => 'required|in:paid,unpaid',
            'description' => 'nullable|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,webp|max:5120',
            'remove_image' => 'nullable|boolean',
        ];

        if ($record->type === 'bill') {
            $rules['category'] = 'required|in:water,electricity,gas';
        } elseif ($record->type === 'service') {
            $rules['title'] = 'required|string|max:255';
            $rules['responsible_party'] = 'required|in:residents,owners';
        } else {
            return response()->json([
                'message' => 'نوع این رکورد قابل ویرایش نیست.',
            ], 422);
        }

        $validated = $request->validate($rules, [
            'title.required' => 'عنوان هزینه را وارد کنید.',
            'category.required' => 'نوع قبض را انتخاب کنید.',
            'category.in' => 'نوع قبض معتبر نیست.',
            'amount.required' => 'مبلغ را وارد کنید.',
            'amount.integer' => 'مبلغ باید عدد صحیح باشد.',
            'amount.min' => 'مبلغ باید بیشتر از صفر باشد.',
            'date.required' => 'تاریخ را انتخاب کنید.',
            'payment_status.required' => 'وضعیت پرداخت را انتخاب کنید.',
            'payment_status.in' => 'وضعیت پرداخت معتبر نیست.',
            'responsible_party.required' => 'مسئول پرداخت را مشخص کنید.',
            'responsible_party.in' => 'مسئول پرداخت معتبر نیست.',
            'image.image' => 'فایل انتخاب‌شده باید تصویر باشد.',
            'image.mimes' => 'فرمت تصویر باید JPG، PNG یا WebP باشد.',
            'image.max' => 'حجم تصویر نباید بیشتر از ۵ مگابایت باشد.',
        ]);

        try {
            $date = $this->jalaliToGregorian($validated['date']);
        } catch (Throwable $exception) {
            return response()->json([
                'message' => 'تاریخ واردشده معتبر نیست.',
            ], 422);
        }

        $newImagePath = null;

        try {
            if ($request->hasFile('image')) {
                $newImagePath = $request->file('image')
                    ->store('building-expenses', 'public');
            }

            $updateData = [
                'amount' => (int) $validated['amount'],
                'date' => $date,
                'payment_status' => $validated['payment_status'],
                'description' => $validated['description'] ?? null,
            ];

            if ($record->type === 'bill') {
                $updateData['category'] = $validated['category'];

                $titles = [
                    'water' => 'قبض آب',
                    'electricity' => 'قبض برق',
                    'gas' => 'قبض گاز',
                ];

                $updateData['title'] = $titles[$validated['category']];
            } else {
                $updateData['title'] = $validated['title'];

                $updateData['responsible_party'] =
                    $validated['responsible_party'] === 'owners'
                        ? 'owner'
                        : 'resident';
            }

            if ($newImagePath !== null) {
                $updateData['image_path'] = $newImagePath;
            } elseif ($request->boolean('remove_image')) {
                $updateData['image_path'] = null;
            }

            $oldImagePath = $record->image_path;

            $record->update($updateData);

            if (
                $oldImagePath &&
                (
                    $newImagePath !== null ||
                    $request->boolean('remove_image')
                )
            ) {
                Storage::disk('public')->delete($oldImagePath);
            }
        } catch (Throwable $exception) {
            if ($newImagePath !== null) {
                Storage::disk('public')->delete($newImagePath);
            }

            report($exception);

            return response()->json([
                'message' => 'ذخیره تغییرات انجام نشد. دوباره تلاش کنید.',
            ], 500);
        }

        return response()->json([
            'message' => 'تغییرات با موفقیت ذخیره شد.',
            'expense' => $this->formatExpenseForModal($record->fresh()),
        ]);
    }

    /**
     * حذف قبض یا هزینه خدماتی.
     *
     * اگر برای رکورد تعهد مالی واحدها ثبت شده باشد، حذف مسدود می‌شود
     * تا سوابق مالی وابسته ناخواسته از بین نروند.
     */
    public function destroy(Request $request, int $expense)
    {
        $record = $this->findManagerExpense($request, $expense);

        if ($record->obligations()->exists()) {
            return response()->json([
                'message' => 'برای این هزینه تعهد مالی ثبت شده است. ابتدا باید وضعیت تعهدهای وابسته مشخص شود.',
            ], 409);
        }

        $imagePath = $record->image_path;

        try {
            $record->delete();

            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
        } catch (Throwable $exception) {
            report($exception);

            return response()->json([
                'message' => 'حذف انجام نشد. دوباره تلاش کنید.',
            ], 500);
        }

        return response()->json([
            'message' => 'رکورد با موفقیت حذف شد.',
            'id' => $expense,
        ]);
    }

    /**
     * پیدا کردن رکورد فقط در ساختمان متعلق به مدیر واردشده.
     */
    private function findManagerExpense(
        Request $request,
        int $expense
    ): BuildingExpense {
        $building = $request->user()
            ->buildings()
            ->first();

        abort_if(!$building, 404, 'ساختمان پیدا نشد.');

        return $building->expenses()
            ->whereKey($expense)
            ->firstOrFail();
    }

    /**
     * آماده‌سازی اطلاعات برای ارسال به مودال.
     */
    private function formatExpenseForModal(
        BuildingExpense $expense
    ): array {
        $date = Carbon::parse($expense->date);

        $jalaliDate = Jalalian::fromCarbon($date)->format('Y/m/d');

        return [
            'id' => $expense->id,
            'type' => $expense->type,
            'title' => $expense->title,
            'category' => $expense->category,
            'amount' => (int) $expense->amount,
            'date' => $jalaliDate,
            'payment_status' => $expense->payment_status,
            'responsible_party' => match ($expense->responsible_party) {
                'owner', 'owners' => 'owners',
                default => 'residents',
            },
            'description' => $expense->description,
            'image_path' => $expense->image_path,
            'image_url' => $expense->image_path
                ? Storage::disk('public')->url($expense->image_path)
                : null,
            'is_separate_from_charge' =>
                (bool) $expense->is_separate_from_charge,
        ];
    }

    /**
     * ثبت قبض آب، برق یا گاز.
     */
    public function storeBill(Request $request)
    {
        $building = $request->user()->buildings()->first();

        if (!$building) {
            return back()->with('error', 'ابتدا ساختمان را ثبت کنید.');
        }

        $request->merge([
            'amount' => $this->normalizeDigits(
                str_replace(
                    [',', '٬', ' '],
                    '',
                    (string) $request->input('amount')
                )
            ),
            'date' => $this->normalizeDigits(
                (string) $request->input('date')
            ),
            'distribution_method' => $request->input('distribution_method')
                ?: 'building_fund',
        ]);

        $validated = $request->validate([
            'category' => 'required|in:water,electricity,gas',
            'amount' => 'required|integer|min:1',
            'date' => 'required|string',
            'payment_status' => 'required|in:paid,unpaid',
            'image' => 'nullable|image|mimes:jpeg,png,webp|max:5120',
            'is_separate_from_charge' => 'nullable|boolean',
            'description' => 'nullable|string|max:5000',
            'distribution_method' => 'required|in:building_fund,per_unit,per_person',
            'distribution_scope' => 'required_if:distribution_method,per_unit|nullable|in:all_units,occupied_units',
        ], [
            'category.required' => 'نوع قبض را انتخاب کنید.',
            'category.in' => 'نوع قبض انتخاب‌شده معتبر نیست.',
            'amount.required' => 'مبلغ قبض را وارد کنید.',
            'amount.integer' => 'مبلغ باید عدد صحیح باشد.',
            'amount.min' => 'مبلغ باید بیشتر از صفر باشد.',
            'date.required' => 'تاریخ قبض را انتخاب کنید.',
            'payment_status.required' => 'وضعیت پرداخت قبض را انتخاب کنید.',
            'payment_status.in' => 'وضعیت پرداخت انتخاب‌شده معتبر نیست.',
            'image.image' => 'فایل انتخاب‌شده باید تصویر باشد.',
            'image.mimes' => 'فرمت تصویر باید JPG، PNG یا WebP باشد.',
            'image.max' => 'حجم تصویر نباید بیشتر از ۵ مگابایت باشد.',
            'distribution_method.required' => 'روش تقسیم هزینه را انتخاب کنید.',
            'distribution_method.in' => 'روش تقسیم انتخاب‌شده معتبر نیست.',
            'distribution_scope.required_if' => 'واحدهای مشمول تقسیم را انتخاب کنید.',
            'distribution_scope.in' => 'محدوده تقسیم انتخاب‌شده معتبر نیست.',
        ]);

        try {
            $date = $this->jalaliToGregorian($validated['date']);
        } catch (Throwable $exception) {
            return back()
                ->withInput()
                ->with('error', 'تاریخ قبض معتبر نیست.');
        }

        $imagePath = null;

        try {
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')
                    ->store('building-expenses', 'public');
            }

            $titles = [
                'water' => 'قبض آب',
                'electricity' => 'قبض برق',
                'gas' => 'قبض گاز',
            ];

            $method = $validated['distribution_method'];
            $scope = $method === 'per_unit'
                ? $validated['distribution_scope']
                : null;

            DB::transaction(function () use (
                $building,
                $validated,
                $titles,
                $date,
                $method,
                $scope,
                $imagePath
            ) {
                $expense = $building->expenses()->create([
                    'type' => 'bill',
                    'title' => $titles[$validated['category']],
                    'category' => $validated['category'],
                    'amount' => $validated['amount'],
                    'date' => $date,
                    'payment_status' => $validated['payment_status'],
                    'responsible_party' => 'resident',
                    'distribution_method' => $method,
                    'distribution_scope' => $scope,
                    'is_separate_from_charge' =>
                        (bool) ($validated['is_separate_from_charge'] ?? false),
                    'description' => $validated['description'] ?? null,
                    'image_path' => $imagePath,
                ]);

                $this->createExpenseObligations(
                    $expense,
                    $building,
                    $method,
                    $scope,
                    'resident'
                );
            });
        } catch (ValidationException $exception) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            throw $exception;
        } catch (Throwable $exception) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            report($exception);

            return back()->withInput()->with(
                'error',
                'ثبت قبض انجام نشد. دوباره تلاش کنید.'
            );
        }

        return back()->with('success', 'قبض با موفقیت ثبت شد.');
    }

    /**
     * ثبت هزینه خدماتی.
     */
    public function storeServiceExpense(Request $request)
    {
        $building = $request->user()->buildings()->first();

        if (!$building) {
            return back()->with('error', 'ابتدا ساختمان را ثبت کنید.');
        }

        $request->merge([
            'amount' => $this->normalizeDigits(
                str_replace(
                    [',', '٬', ' '],
                    '',
                    (string) $request->input('amount')
                )
            ),
            'date' => $this->normalizeDigits(
                (string) $request->input('date')
            ),
            'distribution_method' => $request->input('distribution_method')
                ?: 'building_fund',
        ]);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|integer|min:1',
            'date' => 'required|string',
            'responsible_party' => 'required|in:residents,owners',
            'payment_status' => 'required|in:paid,unpaid',
            'image' => 'nullable|image|mimes:jpeg,png,webp|max:5120',
            'description' => 'nullable|string|max:5000',
            'distribution_method' => 'required|in:building_fund,per_unit,per_person',
            'distribution_scope' => 'required_if:distribution_method,per_unit|nullable|in:all_units,occupied_units',
        ], [
            'title.required' => 'عنوان هزینه را وارد کنید.',
            'title.max' => 'عنوان هزینه نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'amount.required' => 'مبلغ هزینه را وارد کنید.',
            'amount.integer' => 'مبلغ باید عدد صحیح باشد.',
            'amount.min' => 'مبلغ باید بیشتر از صفر باشد.',
            'date.required' => 'تاریخ هزینه را انتخاب کنید.',
            'responsible_party.required' => 'مسئول پرداخت را مشخص کنید.',
            'responsible_party.in' => 'مسئول پرداخت انتخاب‌شده معتبر نیست.',
            'payment_status.required' => 'وضعیت پرداخت هزینه را انتخاب کنید.',
            'payment_status.in' => 'وضعیت پرداخت انتخاب‌شده معتبر نیست.',
            'image.image' => 'فایل انتخاب‌شده باید تصویر باشد.',
            'image.mimes' => 'فرمت تصویر باید JPG، PNG یا WebP باشد.',
            'image.max' => 'حجم تصویر نباید بیشتر از ۵ مگابایت باشد.',
            'distribution_method.required' => 'روش تقسیم هزینه را انتخاب کنید.',
            'distribution_method.in' => 'روش تقسیم انتخاب‌شده معتبر نیست.',
            'distribution_scope.required_if' => 'واحدهای مشمول تقسیم را انتخاب کنید.',
            'distribution_scope.in' => 'محدوده تقسیم انتخاب‌شده معتبر نیست.',
        ]);

        try {
            $date = $this->jalaliToGregorian($validated['date']);
        } catch (Throwable $exception) {
            return back()
                ->withInput()
                ->with('error', 'تاریخ هزینه معتبر نیست.');
        }

        $imagePath = null;

        try {
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')
                    ->store('building-expenses', 'public');
            }

            $method = $validated['distribution_method'];
            $scope = $method === 'per_unit'
                ? $validated['distribution_scope']
                : null;

            $responsibleParty = $validated['responsible_party'] === 'owners'
                ? 'owner'
                : 'resident';

            DB::transaction(function () use (
                $building,
                $validated,
                $date,
                $method,
                $scope,
                $responsibleParty,
                $imagePath
            ) {
                $expense = $building->expenses()->create([
                    'type' => 'service',
                    'title' => $validated['title'],
                    'category' => null,
                    'amount' => $validated['amount'],
                    'date' => $date,
                    'payment_status' => $validated['payment_status'],
                    'responsible_party' => $responsibleParty,
                    'distribution_method' => $method,
                    'distribution_scope' => $scope,
                    'is_separate_from_charge' => false,
                    'description' => $validated['description'] ?? null,
                    'image_path' => $imagePath,
                ]);

                $this->createExpenseObligations(
                    $expense,
                    $building,
                    $method,
                    $scope,
                    $responsibleParty
                );
            });
        } catch (ValidationException $exception) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            throw $exception;
        } catch (Throwable $exception) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            report($exception);

            return back()->withInput()->with(
                'error',
                'ثبت هزینه انجام نشد. دوباره تلاش کنید.'
            );
        }

        return back()->with('success', 'هزینه خدماتی با موفقیت ثبت شد.');
    }

    /**
     * تبدیل ارقام فارسی و عربی به انگلیسی.
     */
    private function normalizeDigits(string $value): string
    {
        return strtr($value, [
            '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3',
            '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7',
            '۸' => '8', '۹' => '9',
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3',
            '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7',
            '٨' => '8', '٩' => '9',
        ]);
    }

    /**
     * تبدیل تاریخ جلالی به میلادی.
     */
    private function jalaliToGregorian(string $date): string
    {
        $date = str_replace('-', '/', trim($date));

        if (!preg_match('/^\d{4}\/\d{1,2}\/\d{1,2}$/', $date)) {
            throw new \InvalidArgumentException('Invalid Jalali date.');
        }

        $parts = explode('/', $date);

        $normalizedDate = sprintf(
            '%04d/%02d/%02d',
            (int) $parts[0],
            (int) $parts[1],
            (int) $parts[2]
        );

        $jalali = Jalalian::fromFormat('Y/m/d', $normalizedDate);

        if ($jalali->format('Y/m/d') !== $normalizedDate) {
            throw new \InvalidArgumentException('Invalid Jalali date.');
        }

        return $jalali->toCarbon()->format('Y-m-d');
    }
    private function createExpenseObligations(
        $expense,
        $building,
        string $method,
        ?string $scope,
        string $responsibleParty
    ): void {
        if ($method === 'building_fund') {
            return;
        }

        $today = now()->toDateString();

        $units = Unit::query()
            ->where('building_id', $building->id)
            ->with([
                'residencies' => function ($query) use ($today) {
                    $query
                        ->whereDate('started_at', '<=', $today)
                        ->where(function ($q) use ($today) {
                            $q->whereNull('ended_at')
                                ->orWhereDate('ended_at', '>=', $today);
                        })
                        ->orderByDesc('started_at');
                },
            ])
            ->orderBy('id')
            ->get();

        if ($method === 'per_unit' && $scope === 'occupied_units') {
            $units = $units->filter(
                fn ($unit) => $unit->residencies->isNotEmpty()
            )->values();
        }

        if ($method === 'per_person') {
            $units = $units->filter(
                fn ($unit) => $unit->residencies->isNotEmpty()
            )->values();

            foreach ($units as $unit) {
                $residency = $unit->residencies->first();

                if (
                    $residency->resident_count === null ||
                    $residency->resident_count < 1
                ) {
                    throw ValidationException::withMessages([
                        'distribution_method' =>
                            "تعداد ساکنان واحد «{$unit->unit_name}» مشخص نیست. ابتدا اطلاعات ساکنان این واحد را تکمیل کن.",
                    ]);
                }
            }
        }

        if ($units->isEmpty()) {
            throw ValidationException::withMessages([
                'distribution_method' =>
                    'برای روش تقسیم انتخاب‌شده، واحد واجد شرایطی در ساختمان وجود ندارد.',
            ]);
        }

        $shares = [];

        if ($method === 'per_unit') {
            $count = $units->count();
            $base = intdiv((int) $expense->amount, $count);
            $remainder = (int) $expense->amount % $count;

            foreach ($units as $index => $unit) {
                $shares[] = [
                    'unit_id' => $unit->id,
                    'amount' => $base + ($index < $remainder ? 1 : 0),
                ];
            }
        } elseif ($method === 'per_person') {
            $totalResidents = $units->sum(
                fn ($unit) => (int) $unit->residencies->first()->resident_count
            );

            if ($totalResidents < 1) {
                throw ValidationException::withMessages([
                    'distribution_method' =>
                        'تعداد ساکنان برای تقسیم هزینه کافی نیست.',
                ]);
            }

            $amount = (int) $expense->amount;
            $remaining = $amount;
            $remainders = [];

            foreach ($units as $unit) {
                $residentCount = (int) $unit->residencies->first()->resident_count;

                $share = intdiv($amount, $totalResidents) * $residentCount
                    + intdiv(($amount % $totalResidents) * $residentCount, $totalResidents);

                $fraction = (($amount % $totalResidents) * $residentCount)
                    % $totalResidents;

                $shares[] = [
                    'unit_id' => $unit->id,
                    'amount' => $share,
                ];

                $remaining -= $share;

                $remainders[] = [
                    'index' => count($shares) - 1,
                    'fraction' => $fraction,
                ];
            }

            usort(
                $remainders,
                fn ($a, $b) => $b['fraction'] <=> $a['fraction']
            );

            for ($i = 0; $i < $remaining; $i++) {
                $shares[$remainders[$i]['index']]['amount']++;
            }
        } else {
            throw ValidationException::withMessages([
                'distribution_method' => 'روش تقسیم انتخاب‌شده معتبر نیست.',
            ]);
        }

        foreach ($shares as $share) {
            UnitObligation::create([
                'unit_id' => $share['unit_id'],
                'building_expense_id' => $expense->id,
                'type' => $expense->type,
                'title' => $expense->title,
                'amount' => $share['amount'],
                'responsible_party' => $responsibleParty,
                'due_date' => null,
                'description' => $expense->description,
            ]);
        }
    }
}