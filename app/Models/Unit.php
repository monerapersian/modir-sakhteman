<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    use HasFactory;

    /**
     * فیلدهایی که اجازه Mass Assignment دارند.
     */
    protected $fillable = [
        'building_id',
        'unit_name',
        'floor',
        'unit_type',
        'occupancy_status',
        'area',
        'parking',
        'storage',
    ];

    /**
     * ساختمان مربوط به واحد.
     */
    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    /**
     * سوابق مالکیت واحد.
     */
    public function ownerships(): HasMany
    {
        return $this->hasMany(UnitOwnership::class);
    }

    /**
     * سوابق سکونت واحد.
     */
    public function residencies(): HasMany
    {
        return $this->hasMany(UnitResidency::class);
    }

    /**
     * تعهدات مالی واحد.
     */
    public function obligations(): HasMany
    {
        return $this->hasMany(UnitObligation::class);
    }
}