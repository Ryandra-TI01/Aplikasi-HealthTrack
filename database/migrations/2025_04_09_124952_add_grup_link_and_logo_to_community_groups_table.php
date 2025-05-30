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
        Schema::table('community_groups', function (Blueprint $table) {
            $table->string('group_link')->nullable()->after('description');
            $table->string('logo')->nullable()->after('group_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('community_groups', function (Blueprint $table) {
            $table->dropColumn(['group_link', 'logo']);
        });
    }
};
