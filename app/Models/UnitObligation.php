<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UnitObligation extends Model
{
    use HasFactory;

    /**
     * فیلدهایی که اجازه Mass Assignment دارند.
     */
    protected $fillable = [
        'unit_id',
        'charge_period_id',
        'building_expense_id',
        'type',
        'title',
        'amount',
        'responsible_party',
        'due_date',
        'description',
    ];

    /**
     * واحد مربوط به این تعهد مالی.
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * دوره شارژی که این تعهد از آن ایجاد شده.
     */
    public function chargePeriod(): BelongsTo
    {
        return $this->belongsTo(ChargePeriod::class);
    }

    /**
     * قبض یا هزینه خدماتی که این تعهد از آن ایجاد شده.
     */
    public function buildingExpense(): BelongsTo
    {
        return $this->belongsTo(BuildingExpense::class);
    }

    /**
     * پرداخت‌های ثبت‌شده برای این تعهد.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * تبدیل فیلدها به نوع مناسب.
     */
    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'due_date' => 'date',
        ];
    }
}