<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('medical_schedules', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::table('medical_schedules', function (Blueprint $table) {
            $table->enum('type', ['medicine', 'consultation', 'lab test', 'therapy and sports'])->default('medicine')->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('medical_schedules', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::table('medical_schedules', function (Blueprint $table) {
            $table->enum('type', ['medicine', 'appointment'])->default('medicine')->after('title');
        });
    }
};
