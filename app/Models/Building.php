<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model
{
    use HasFactory;

    /**
     * فیلدهایی که اجازه Mass Assignment دارند.
     */
    protected $fillable = [
        'manager_id',
        'name',
        'address',
        'construction_year',
        'floors',
        'residential_units',
        'administrative_units',
        'commercial_units',
        'elevator_lines',
        'parking_spaces',
        'storage_rooms',
        'has_meeting_hall',
        'has_pool',
        'has_sauna',
        'has_jacuzzi',
        'has_roof_garden',
        'has_security',
        'has_caretaker',
        'has_garbage_chute',
        'has_playground',
        'has_green_space',
        'has_fire_alarm',
        'has_fire_suppression',
        'has_public_restroom',
        'description',
        'occupied_monthly_charge',
        'vacant_monthly_charge',
    ];

    /**
     * مدیر اصلی ساختمان.
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * واحدهای ساختمان.
     */
    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }

    /**
     * دوره‌های شارژ ساختمان.
     */
    public function chargePeriods(): HasMany
    {
        return $this->hasMany(ChargePeriod::class);
    }

    /**
     * قبض‌ها و هزینه‌های خدماتی ساختمان.
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(BuildingExpense::class);
    }
}