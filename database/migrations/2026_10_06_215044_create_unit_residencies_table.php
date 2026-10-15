<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unit_residencies', function (Blueprint $table) {
            $table->id();

            $table->foreignId('unit_id')
                ->constrained('units')
                ->cascadeOnDelete();

            // اطلاعات ساکن
            $table->string('name');
            $table->string('phone')->nullable();
            $table->unsignedTinyInteger('resident_count')->nullable();

            // نوع ساکن: مالک یا مستأجر
            $table->enum('resident_type', ['owner', 'tenant']);

            // بازه سکونت
            $table->date('started_at');
            $table->date('ended_at')->nullable();

            // توضیحات تکمیلی
            $table->text('notes')->nullable();

            $table->timestamps();

            // جلوگیری از ثبت دو سابقه با تاریخ شروع یکسان برای یک واحد
            $table->unique(['unit_id', 'started_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unit_residencies');
    }
};