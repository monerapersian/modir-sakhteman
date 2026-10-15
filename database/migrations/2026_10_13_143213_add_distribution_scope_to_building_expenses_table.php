<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('building_expenses', function (Blueprint $table) {
            $table->enum('distribution_scope', [
                'all_units',
                'occupied_units',
            ])->nullable()->after('distribution_method');
        });
    }

    public function down(): void
    {
        Schema::table('building_expenses', function (Blueprint $table) {
            $table->dropColumn('distribution_scope');
        });
    }
};