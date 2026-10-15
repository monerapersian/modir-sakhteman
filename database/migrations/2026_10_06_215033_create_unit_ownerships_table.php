<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unit_ownerships', function (Blueprint $table) {
            $table->id();

            $table->foreignId('unit_id')
                ->constrained('units')
                ->cascadeOnDelete();

            // اطلاعات مالک
            $table->string('name');
            $table->string('phone')->nullable();

            // بازه مالکیت
            $table->date('started_at');
            $table->date('ended_at')->nullable();

            // توضیحات تکمیلی
            $table->text('notes')->nullable();

            $table->timestamps();

            // فقط یک رکورد برای یک مالک در یک تاریخ شروع
            $table->unique(['unit_id', 'started_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unit_ownerships');
    }
};