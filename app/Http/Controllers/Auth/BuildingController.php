<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    /**
     * ذخیره اطلاعات تکمیلی ساختمان.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'construction_year' => ['nullable', 'integer', 'min:1300', 'max:1500'],
            'floor_count' => ['required', 'integer', 'min:1'],

            'residential_units' => ['required', 'integer', 'min:0'],
            'administrative_units' => ['required', 'integer', 'min:0'],
            'commercial_units' => ['required', 'integer', 'min:0'],

            'elevator_lanes' => ['required', 'integer', 'min:0'],
            'parking_spaces' => ['required', 'integer', 'min:0'],
            'storage_rooms' => ['required', 'integer', 'min:0'],

            'facilities' => ['nullable', 'array'],
            'facilities.*' => [
                'in:community_hall,pool,sauna,jacuzzi,rooftop_garden,security,caretaker,garbage_chute,playground,green_space,fire_alarm,fire_suppression,public_restroom',
            ],

            'description' => ['nullable', 'string'],
        ]);

        $user = $request->user();

        $building = Building::where('manager_id', $user->id)->first();

        if (!$building) {
            return redirect()
                ->route('home')
                ->with('error', 'ساختمان شما پیدا نشد.');
        }

        $facilities = $validated['facilities'] ?? [];

        $building->update([
            'construction_year' => $validated['construction_year'] ?? null,
            'floors' => $validated['floor_count'],

            'residential_units' => $validated['residential_units'],
            'administrative_units' => $validated['administrative_units'],
            'commercial_units' => $validated['commercial_units'],

            'elevator_lines' => $validated['elevator_lanes'],
            'parking_spaces' => $validated['parking_spaces'],
            'storage_rooms' => $validated['storage_rooms'],

            'has_meeting_hall' => in_array('community_hall', $facilities),
            'has_pool' => in_array('pool', $facilities),
            'has_sauna' => in_array('sauna', $facilities),
            'has_jacuzzi' => in_array('jacuzzi', $facilities),
            'has_roof_garden' => in_array('rooftop_garden', $facilities),
            'has_security' => in_array('security', $facilities),
            'has_caretaker' => in_array('caretaker', $facilities),
            'has_garbage_chute' => in_array('garbage_chute', $facilities),
            'has_playground' => in_array('playground', $facilities),
            'has_green_space' => in_array('green_space', $facilities),
            'has_fire_alarm' => in_array('fire_alarm', $facilities),
            'has_fire_suppression' => in_array('fire_suppression', $facilities),
            'has_public_restroom' => in_array('public_restroom', $facilities),

            'description' => $validated['description'] ?? null,
        ]);

        return redirect()
            ->route('manager.dashboard')
            ->with('success', 'اطلاعات ساختمان با موفقیت ثبت شد.');
    }
}