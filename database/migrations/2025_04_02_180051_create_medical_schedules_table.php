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
        Schema::create('medical_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke user
            $table->enum('type', ['medicine', 'appointment'])->default('medicine'); // Jenis pengingat
            $table->string('title'); // Judul pengingat (misal: "Minum obat darah tinggi")
            $table->text('description')->nullable(); // Deskripsi tambahan
            $table->dateTime('reminder_time'); // Waktu pengingat
            $table->boolean('is_completed')->default(false); // Status selesai/belum
            $table->enum('repeat_interval', ['none', 'daily', 'weekly', 'monthly'])->default('none');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_schedules');
    }
};
