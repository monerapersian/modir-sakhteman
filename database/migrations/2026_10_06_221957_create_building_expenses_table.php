<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('building_expenses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('building_id')
                ->constrained('buildings')
                ->cascadeOnDelete();

            // نوع هزینه
            $table->enum('type', ['bill', 'service']);

            // عنوان
            $table->string('title');

            // دسته‌بندی قبض یا هزینه خدماتی
            $table->string('category')->nullable();

            // مبلغ کل
            $table->unsignedBigInteger('amount');

            // تاریخ هزینه / قبض
            $table->date('date');

            // مسئول پرداخت
            $table->enum('responsible_party', ['owner', 'resident']);

            // روش تقسیم بین واحدها
            $table->enum('distribution_method', ['per_unit', 'per_person']);

            // آیا سهم هر واحد به صورت تعهد مالی جداگانه ثبت شود؟
            $table->boolean('is_separate_from_charge')->default(false);

            // توضیحات
            $table->text('description')->nullable();

            $table->timestamps();

            $table->index(['building_id', 'date']);
            $table->index(['building_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('building_expenses');
    }
};