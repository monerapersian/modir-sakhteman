<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();

            $table->foreignId('building_id')
                ->constrained('buildings')
                ->cascadeOnDelete();

            // اطلاعات اصلی واحد
            $table->string('unit_name');
            $table->unsignedSmallInteger('floor');
            $table->enum('unit_type', [
                'residential',
                'administrative',
                'commercial',
            ]);
            $table->enum('occupancy_status', [
                'occupied',
                'vacant',
            ]);

            // اطلاعات تکمیلی
            $table->decimal('area', 10, 2)->nullable();

            // پارکینگ و انباری
            $table->string('parking', 5)->nullable();
            $table->boolean('storage')->default(false);

            $table->timestamps();

            // نام واحد در هر ساختمان باید یکتا باشد
            $table->unique(['building_id', 'unit_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};