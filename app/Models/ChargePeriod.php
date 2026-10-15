<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChargePeriod extends Model
{
    use HasFactory;

    /**
     * فیلدهایی که اجازه Mass Assignment دارند.
     */
    protected $fillable = [
        'building_id',
        'title',
        'starts_at',
        'ends_at',
        'occupied_amount',
        'vacant_amount',
        'description',
    ];

    /**
     * ساختمان مربوط به این دوره شارژ.
     */
    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    /**
     * تعهدات مالی ایجادشده از این دوره شارژ.
     */
    public function obligations(): HasMany
    {
        return $this->hasMany(UnitObligation::class);
    }

    /**
     * تبدیل تاریخ‌ها و مبالغ به نوع مناسب.
     */
    protected function casts(): array
    {
        return [
            'starts_at' => 'date',
            'ends_at' => 'date',
            'occupied_amount' => 'integer',
            'vacant_amount' => 'integer',
        ];
    }
}