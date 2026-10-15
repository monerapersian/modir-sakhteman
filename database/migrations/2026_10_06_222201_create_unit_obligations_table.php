<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unit_obligations', function (Blueprint $table) {
            $table->id();

            // واحد
            $table->foreignId('unit_id')
                ->constrained('units')
                ->cascadeOnDelete();

            // منبع تعهد مالی: دوره شارژ
            $table->foreignId('charge_period_id')
                ->nullable()
                ->constrained('charge_periods')
                ->nullOnDelete();

            // منبع تعهد مالی: قبض یا هزینه خدماتی
            $table->foreignId('building_expense_id')
                ->nullable()
                ->constrained('building_expenses')
                ->nullOnDelete();

            // نوع تعهد مالی
            $table->enum('type', [
                'charge',
                'bill',
                'service',
                'previous_debt',
            ]);

            // عنوان تعهد
            $table->string('title');

            // مبلغ
            $table->unsignedBigInteger('amount');

            // مسئول پرداخت
            $table->enum('responsible_party', [
                'owner',
                'resident',
            ]);

            // تاریخ سررسید
            $table->date('due_date')->nullable();

            // توضیحات
            $table->text('description')->nullable();

            $table->timestamps();

            // ایندکس برای گزارش‌ها و جستجوهای مالی
            $table->index(['unit_id', 'type']);
            $table->index(['unit_id', 'due_date']);
            $table->index('charge_period_id');
            $table->index('building_expense_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unit_obligations');
    }
};