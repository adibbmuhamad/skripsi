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
        Schema::table('class_rooms', function (Blueprint $table) {
            $table->string('room_number')->nullable(); // Nomor ruangan
            $table->integer('capacity')->nullable(); // Kapasitas
            $table->string('class_teacher')->nullable(); // Wali kelas
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('class_rooms', function (Blueprint $table) {
            $table->dropColumn(['room_number', 'capacity', 'class_teacher']);
        });
    }
};
