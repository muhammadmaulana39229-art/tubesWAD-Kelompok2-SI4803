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
        Schema::create('pengingats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Untuk menghubungkan pengingat dengan mahasiswa yang login
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->dateTime('waktu_pengingat'); // Waktu spesifik kapan pengingat harus muncul
            $table->boolean('status_muncul')->default(false); // Status apakah pengingat sudah ditampilkan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengingats');
    }
};
