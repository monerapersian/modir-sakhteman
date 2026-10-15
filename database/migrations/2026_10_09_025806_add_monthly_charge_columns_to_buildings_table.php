<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('buildings', function (Blueprint $table) {
            if (!Schema::hasColumn('buildings', 'occupied_monthly_charge')) {
                $table->unsignedBigInteger('occupied_monthly_charge')->nullable();
            }

            if (!Schema::hasColumn('buildings', 'vacant_monthly_charge')) {
                $table->unsignedBigInteger('vacant_monthly_charge')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('buildings', function (Blueprint $table) {
            $columns = [];

            if (Schema::hasColumn('buildings', 'occupied_monthly_charge')) {
                $columns[] = 'occupied_monthly_charge';
            }

            if (Schema::hasColumn('buildings', 'vacant_monthly_charge')) {
                $columns[] = 'vacant_monthly_charge';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};