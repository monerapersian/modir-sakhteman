<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    /**
     * فیلدهایی که اجازه Mass Assignment دارند.
     */
    protected $fillable = [
        'unit_obligation_id',
        'created_by',
        'amount',
        'paid_at',
        'description',
    ];

    /**
     * تعهد مالی مربوط به این پرداخت.
     */
    public function obligation(): BelongsTo
    {
        return $this->belongsTo(UnitObligation::class, 'unit_obligation_id');
    }

    /**
     * کاربری که پرداخت را ثبت کرده است.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * تبدیل فیلدها به نوع مناسب.
     */
    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'paid_at' => 'date',
        ];
    }
}