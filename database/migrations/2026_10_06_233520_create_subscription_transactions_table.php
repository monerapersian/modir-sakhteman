<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscription_transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('subscription_id')
                ->constrained('subscriptions')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('discount_coupon_id')
                ->nullable()
                ->constrained('discount_coupons')
                ->nullOnDelete();

            // مبلغ اصلی پلن در زمان خرید
            $table->unsignedBigInteger('amount');

            // اطلاعات تخفیف در زمان خرید
            $table->string('discount_code')->nullable();
            $table->unsignedTinyInteger('discount_percent')->nullable();
            $table->unsignedBigInteger('discount_amount')->default(0);

            // مبلغ نهایی پرداخت
            $table->unsignedBigInteger('final_amount');

            $table->enum('status', [
                'pending',
                'paid',
                'failed',
                'cancelled',
            ])->default('pending');

            // اطلاعات درگاه پرداخت
            $table->string('gateway')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('gateway_reference')->nullable();

            $table->dateTime('paid_at')->nullable();

            $table->text('description')->nullable();

            $table->timestamps();

            $table->index(['subscription_id', 'status']);
            $table->index(['user_id', 'status']);
            $table->index(['gateway', 'transaction_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_transactions');
    }
};