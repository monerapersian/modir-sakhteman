<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // تعهد مالی
            $table->foreignId('unit_obligation_id')
                ->constrained('unit_obligations')
                ->cascadeOnDelete();

            // کاربری که پرداخت را ثبت کرده
            $table->foreignId('created_by')
                ->constrained('users')
                ->restrictOnDelete();

            // مبلغ پرداخت
            $table->unsignedBigInteger('amount');

            // تاریخ واقعی پرداخت
            $table->date('paid_at');

            // توضیحات
            $table->text('description')->nullable();

            $table->timestamps();

            // برای گزارش‌گیری پرداخت‌ها
            $table->index(['unit_obligation_id', 'paid_at']);
            $table->index(['created_by', 'paid_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};