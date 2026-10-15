<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BuildingExpense extends Model
{
    use HasFactory;

    /**
     * فیلدهایی که اجازه Mass Assignment دارند.
     */
    protected $fillable = [
        'building_id',
        'type',
        'title',
        'category',
        'amount',
        'date',
        'responsible_party',
        'distribution_method',
        'distribution_scope',
        'is_separate_from_charge',
        'description',
        'image_path',
        'payment_status',
    ];

    /**
     * ساختمان مربوط به قبض یا هزینه خدماتی.
     */
    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    /**
     * تعهدات مالی ایجادشده از این قبض یا هزینه خدماتی.
     */
    public function obligations(): HasMany
    {
        return $this->hasMany(UnitObligation::class);
    }

    /**
     * تبدیل فیلدها به نوع مناسب.
     */
    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'date' => 'date',
            'is_separate_from_charge' => 'boolean',
        ];
    }
}