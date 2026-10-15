<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('charge_periods', function (Blueprint $table) {
            $table->id();

            $table->foreignId('building_id')
                ->constrained('buildings')
                ->cascadeOnDelete();

            // عنوان دوره شارژ
            $table->string('title');

            // بازه زمانی شارژ
            $table->date('starts_at');
            $table->date('ends_at');

            // مبلغ شارژ بر اساس وضعیت سکونت
            $table->unsignedBigInteger('occupied_amount')->default(0);
            $table->unsignedBigInteger('vacant_amount')->default(0);

            // توضیحات
            $table->text('description')->nullable();

            $table->timestamps();

            $table->index(['building_id', 'starts_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('charge_periods');
    }
};