<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\UnitObligation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * نمایش داشبورد مدیریت ساختمان.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // ساختمان مدیر
        $building = $user->buildings()->first();

        // اگر ساختمان برای مدیر پیدا نشد
        if (!$building) {
            return redirect()
                ->route('building.create')
                ->with('error', 'اطلاعات ساختمان شما هنوز ثبت نشده است.');
        }

        // تاریخ امروز
        $today = today();

        // تعداد کل واحدها
        $totalUnits = $building->units()->count();

        // تعداد واحدهایی که در حال حاضر ساکن دارند
        $occupiedUnits = $building->units()
            ->whereHas('residencies', function ($query) use ($today) {
                $query->whereDate('started_at', '<=', $today)
                    ->where(function ($query) use ($today) {
                        $query->whereNull('ended_at')
                            ->orWhereDate('ended_at', '>=', $today);
                    });
            })
            ->count();

        // تعداد واحدهای خالی
        $vacantUnits = max($totalUnits - $occupiedUnits, 0);

        // درصد واحدهای دارای ساکن
        $occupancyPercentage = $totalUnits > 0
            ? round(($occupiedUnits / $totalUnits) * 100)
            : 0;

        // شناسه واحدهای همین ساختمان
        $unitIds = $building->units()->pluck('id');

        // دریافت تعهدات مالی واحدها به همراه پرداخت‌های ثبت‌شده
        $obligations = UnitObligation::query()
            ->with('payments')
            ->whereIn('unit_id', $unitIds)
            ->get();

        // محاسبه مانده بدهی هر تعهد
        $remainingObligations = $obligations
            ->map(function ($obligation) {
                $paidAmount = (int) $obligation->payments->sum('amount');

                $obligation->remaining_amount = max(
                    0,
                    (int) $obligation->amount - $paidAmount
                );

                return $obligation;
            })
            ->filter(fn ($obligation) => $obligation->remaining_amount > 0);

        // مجموع بدهی باقی‌مانده واحدها
        $totalDebt = (int) $remainingObligations->sum('remaining_amount');

        // تعداد واحدهای منحصربه‌فرد دارای بدهی
        $indebtedUnits = $remainingObligations
            ->pluck('unit_id')
            ->unique()
            ->count();

        return view('manager.dashboard', [
            'building' => $building,
            'totalUnits' => $totalUnits,
            'occupiedUnits' => $occupiedUnits,
            'vacantUnits' => $vacantUnits,
            'occupancyPercentage' => $occupancyPercentage,
            'totalDebt' => $totalDebt,
            'indebtedUnits' => $indebtedUnits,
        ]);
    }
}