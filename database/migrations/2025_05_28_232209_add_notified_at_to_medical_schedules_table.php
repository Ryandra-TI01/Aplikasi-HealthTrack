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
            $table->timestamp('notified_15')->nullable();
            $table->timestamp('notified_10')->nullable();
            $table->timestamp('notified_5')->nullable();
            $table->timestamp('notified_0')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_schedules', function (Blueprint $table) {
            $table->dropColumn(['notified_15', 'notified_10', 'notified_5', 'notified_0']);
        });
    }
};
