<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubscriptionTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'user_id',
        'discount_coupon_id',
        'amount',
        'discount_code',
        'discount_percent',
        'discount_amount',
        'final_amount',
        'status',
        'gateway',
        'transaction_id',
        'gateway_reference',
        'paid_at',
        'description',
    ];

    /**
     * اشتراکی که این تراکنش برای آن انجام شده است.
     */
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * کاربری که این تراکنش متعلق به اوست.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * کد تخفیف استفاده‌شده در این تراکنش.
     */
    public function discountCoupon(): BelongsTo
    {
        return $this->belongsTo(DiscountCoupon::class);
    }

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'discount_percent' => 'integer',
            'discount_amount' => 'integer',
            'final_amount' => 'integer',
            'paid_at' => 'datetime',
        ];
    }
}