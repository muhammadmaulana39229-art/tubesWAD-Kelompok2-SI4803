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
        Schema::table('tugas', function (Blueprint $table) {
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->date('deadline')->nullable();
            $table->string('status')->default('belum selesai');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn(['nama', 'deskripsi', 'deadline', 'status', 'user_id', 'kategori_id']);
        });
    }
};
