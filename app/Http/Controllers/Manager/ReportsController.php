<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\UnitObligation;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ReportsController extends Controller
{
    public function monthlyCharges(Request $request): View|RedirectResponse
    {
        $building = Building::query()
            ->where('manager_id', $request->user()->id)
            ->with('units')
            ->first();

        if (!$building) {
            return redirect()
                ->route('manager.reports')
                ->with('error', 'ساختمان شما پیدا نشد.');
        }

        // آخرین دوره شارژ صادرشده
        $period = $building->chargePeriods()
            ->orderByDesc('starts_at')
            ->first();

        if (!$period) {
            return redirect()
                ->route('manager.reports')
                ->with('error', 'هنوز هیچ دوره شارژی برای ساختمان صادر نشده است.');
        }

        // تعهد شارژ هر واحد در این دوره
        $chargeObligations = UnitObligation::query()
            ->with('payments')
            ->where('charge_period_id', $period->id)
            ->where('type', 'charge')
            ->get()
            ->keyBy('unit_id');

        // سهم آب واحدها در بازه همین دوره
        $waterObligations = UnitObligation::query()
            ->with(['payments', 'buildingExpense'])
            ->whereHas('buildingExpense', function ($query) use ($building, $period) {
                $query
                    ->where('building_id', $building->id)
                    ->whereBetween('date', [
                        $period->starts_at->toDateString(),
                        $period->ends_at->toDateString(),
                    ])
                    ->where(function ($query) {
                        $query
                            ->where('title', 'like', '%آب%')
                            ->orWhere('category', 'like', '%آب%');
                    });
            })
            ->get()
            ->groupBy('unit_id');

        $units = $building->units
            ->sortBy('floor')
            ->sortBy('unit_name')
            ->map(function ($unit) use ($chargeObligations, $waterObligations) {
                $charge = $chargeObligations->get($unit->id);
                $waterItems = $waterObligations->get($unit->id, collect());

                $chargeAmount = (int) ($charge?->amount ?? 0);
                $waterAmount = (int) $waterItems->sum('amount');

                $chargePaid = (int) ($charge?->payments->sum('amount') ?? 0);
                $waterPaid = (int) $waterItems->sum(
                    fn ($obligation) => $obligation->payments->sum('amount')
                );

                $totalAmount = $chargeAmount + $waterAmount;
                $paidAmount = $chargePaid + $waterPaid;

                return [
                    'id' => $unit->id,
                    'name' => $unit->unit_name,
                    'has_resident' => $unit->occupancy_status === 'occupied',
                    'charge_amount' => $chargeAmount,
                    'water_amount' => $waterAmount,
                    'paid_amount' => $paidAmount,
                    'remaining_amount' => max(0, $totalAmount - $paidAmount),
                ];
            })
            ->values();

        $manager = $request->user();

        return view('manager.reports.monthly-charges', [
            'building' => $building,
            'period' => $period,
            'units' => $units,
            'manager' => $manager,
        ]);
    }
    public function debtors(Request $request): View|RedirectResponse
    {
        $request->validate([
            'responsible_party' => ['nullable', 'in:resident,owner'],
        ]);

        $responsibleParty = $request->input('responsible_party', 'resident');

        $building = Building::query()
            ->where('manager_id', $request->user()->id)
            ->with('units')
            ->first();

        if (!$building) {
            return redirect()
                ->route('manager.reports')
                ->with('error', 'ساختمان شما پیدا نشد.');
        }

        $unitIds = $building->units->pluck('id');

        $obligations = UnitObligation::query()
            ->with('payments')
            ->whereIn('unit_id', $unitIds)
            ->where('responsible_party', $responsibleParty)
            ->get()
            ->map(function ($obligation) {
                $paidAmount = (int) $obligation->payments->sum('amount');

                $obligation->remaining_amount = max(
                    0,
                    (int) $obligation->amount - $paidAmount
                );

                return $obligation;
            })
            ->filter(fn ($obligation) => $obligation->remaining_amount > 0)
            ->groupBy('unit_id');

        $units = $building->units
            ->map(function ($unit) use ($obligations) {
                $unitObligations = $obligations->get($unit->id, collect());

                return [
                    'id' => $unit->id,
                    'name' => $unit->unit_name,
                    'debt_count' => $unitObligations->count(),
                    'total_debt' => (int) $unitObligations->sum('remaining_amount'),
                ];
            })
            ->filter(fn ($unit) => $unit['total_debt'] > 0)
            ->sortBy('name')
            ->values();

        return view('manager.reports.debtors', [
            'building' => $building,
            'units' => $units,
            'manager' => $request->user(),
            'responsibleParty' => $responsibleParty,
        ]);
    }
}