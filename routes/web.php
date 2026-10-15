<?php

use App\Http\Controllers\Auth\BuildingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SubscriptionController;
use App\Http\Controllers\Manager\BillsController;
use App\Http\Controllers\Manager\ChargeController;
use App\Http\Controllers\Manager\DashboardController;
use App\Http\Controllers\Manager\UnitController;
use App\Http\Controllers\Manager\ReportsController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('public.home');
})->name('home');


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    if (auth()->check()) {
        return redirect()->route('manager.dashboard');
    }

    return app(\App\Http\Controllers\Auth\LoginController::class)->create();
})->name('login');

Route::post('/login', [LoginController::class, 'store'])
    ->middleware('guest')
    ->name('login.store');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Subscription
|--------------------------------------------------------------------------
*/

Route::get('/subscription', function () {
    $plan = \App\Models\SubscriptionPlan::where('is_active', true)
        ->where('duration_days', 365)
        ->firstOrFail();

    return view('auth.subscription', compact('plan'));
})->name('subscription');

Route::post('/subscription', [SubscriptionController::class, 'store'])
    ->name('subscription.store');

Route::post('/subscription/check-coupon', [SubscriptionController::class, 'checkCoupon'])
    ->name('subscription.check-coupon');


/*
|--------------------------------------------------------------------------
| Building Completion & Manager Panel
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'active.subscription'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Building Registration
    |--------------------------------------------------------------------------
    */

    Route::get('/building/create', function () {
        return view('auth.building-create');
    })->name('building.create');

    Route::post('/building/create', [BuildingController::class, 'store'])
        ->name('building.store');


    /*
    |--------------------------------------------------------------------------
    | Manager Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/manager/dashboard', [DashboardController::class, 'index'])
        ->name('manager.dashboard');


    /*
    |--------------------------------------------------------------------------
    | Units Management
    |--------------------------------------------------------------------------
    */

    // نمایش فهرست واحدها
    Route::get('/manager/units', [UnitController::class, 'index'])
        ->name('manager.units');

    // نمایش فرم ثبت واحد جدید
    Route::get('/manager/units/create', [UnitController::class, 'create'])
        ->name('manager.units.create');

    // ذخیره واحد جدید
    Route::post('/manager/units', [UnitController::class, 'store'])
        ->name('manager.units.store');

    // ثبت پرداخت بدهی در پروفایل واحد
    Route::post(
        '/manager/units/{unit}/obligations/{obligation}/payment',
        [UnitController::class, 'storePayment']
    )
        ->whereNumber('unit')
        ->whereNumber('obligation')
        ->name('manager.units.payment');

    // نمایش پروفایل یک واحد
    Route::get('/manager/units/{unit}', [UnitController::class, 'show'])
        ->whereNumber('unit')
        ->name('manager.units.show');


    /*
    |--------------------------------------------------------------------------
    | Building Charges
    |--------------------------------------------------------------------------
    */

    // نمایش صفحه شارژ ساختمان
    Route::get('/manager/charges', [ChargeController::class, 'index'])
        ->name('manager.charges');

    // ذخیره مبلغ شارژ ثابت ماهیانه
    Route::post('/manager/charges', [ChargeController::class, 'store'])
        ->name('manager.charges.store');

    // صدور شارژ برای دوره انتخاب‌شده
    Route::post('/manager/charges/issue', [ChargeController::class, 'issue'])
        ->name('manager.charges.issue');

    // ثبت پرداخت شارژ یک واحد در صفحه شارژ
    Route::post('/manager/charges/payment', [ChargeController::class, 'storePayment'])
        ->name('manager.charges.payment');


    /*
    |--------------------------------------------------------------------------
    | Bills & Service Expenses
    |--------------------------------------------------------------------------
    */

    // نمایش فهرست قبوض و هزینه‌های خدماتی
    Route::get('/manager/bills', [BillsController::class, 'index'])
        ->name('manager.bills');

    // ثبت قبض جدید
    Route::post('/manager/bills/bill', [BillsController::class, 'storeBill'])
        ->name('manager.bills.store-bill');

    // ثبت هزینه خدماتی جدید
    Route::post('/manager/bills/service-expense', [BillsController::class, 'storeServiceExpense'])
        ->name('manager.bills.store-service-expense');

    // دریافت جزئیات قبض یا هزینه برای مودال ویرایش
    Route::get('/manager/bills/{expense}/details', [BillsController::class, 'show'])
        ->whereNumber('expense')
        ->name('manager.bills.show');

    // ذخیره تغییرات قبض یا هزینه
    Route::patch('/manager/bills/{expense}', [BillsController::class, 'update'])
        ->whereNumber('expense')
        ->name('manager.bills.update');

    // حذف قبض یا هزینه
    Route::delete('/manager/bills/{expense}', [BillsController::class, 'destroy'])
        ->whereNumber('expense')
        ->name('manager.bills.destroy');


    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    */

    Route::get('/manager/reports', function (\Illuminate\Http\Request $request) {
        $building = \App\Models\Building::query()
            ->where('manager_id', $request->user()->id)
            ->with(['chargePeriods' => function ($query) {
                $query->orderByDesc('starts_at');
            }])
            ->first();

        $period = $building?->chargePeriods->first();

        $currentPeriod = $period
            ? \Morilog\Jalali\Jalalian::fromCarbon($period->starts_at)->format('%B %Y')
            : null;

        return view('manager.reports', compact(
            'building',
            'period',
            'currentPeriod'
        ));
    })->name('manager.reports');

    Route::get('/manager/reports/monthly-charges', [
        ReportsController::class,
        'monthlyCharges',
    ])->name('manager.reports.monthly-charges');

    Route::get('/manager/reports/debtors', [
        ReportsController::class,
        'debtors',
    ])->name('manager.reports.debtors');

});