<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('building_expenses', function (Blueprint $table) {
            $table->enum('distribution_method', [
                'building_fund',
                'per_unit',
                'per_person',
            ])->default('building_fund')->change();
        });
    }

    public function down(): void
    {
        Schema::table('building_expenses', function (Blueprint $table) {
            $table->enum('distribution_method', [
                'per_unit',
                'per_person',
            ])->default('per_unit')->change();
        });
    }
};