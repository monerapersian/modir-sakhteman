<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('manager_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // اطلاعات اصلی ساختمان
            $table->string('name');
            $table->text('address')->nullable();

            $table->unsignedSmallInteger('construction_year')->nullable();
            $table->unsignedSmallInteger('floors')->default(0);

            $table->unsignedSmallInteger('residential_units')->default(0);
            $table->unsignedSmallInteger('administrative_units')->default(0);
            $table->unsignedSmallInteger('commercial_units')->default(0);

            $table->unsignedSmallInteger('elevator_lines')->default(0);
            $table->unsignedSmallInteger('parking_spaces')->default(0);
            $table->unsignedSmallInteger('storage_rooms')->default(0);

            // امکانات ساختمان
            $table->boolean('has_meeting_hall')->default(false);
            $table->boolean('has_pool')->default(false);
            $table->boolean('has_sauna')->default(false);
            $table->boolean('has_jacuzzi')->default(false);
            $table->boolean('has_roof_garden')->default(false);
            $table->boolean('has_security')->default(false);
            $table->boolean('has_caretaker')->default(false);
            $table->boolean('has_garbage_chute')->default(false);
            $table->boolean('has_playground')->default(false);
            $table->boolean('has_green_space')->default(false);
            $table->boolean('has_fire_alarm')->default(false);
            $table->boolean('has_fire_suppression')->default(false);
            $table->boolean('has_public_restroom')->default(false);

            // توضیحات تکمیلی
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buildings');
    }
};