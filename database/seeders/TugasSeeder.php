<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tugas;
use App\Models\User;
use App\Models\Kategori;

class TugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first(); // Ambil user pertama
        $kategoris = Kategori::where('user_id', $user->id)->get();

        if ($kategoris->isNotEmpty()) {
            Tugas::create([
                'nama' => 'Tugas Matematika',
                'deskripsi' => 'Kerjakan soal integral',
                'deadline' => now()->addDays(7),
                'status' => 'belum selesai',
                'user_id' => $user->id,
                'kategori_id' => $kategoris->first()->id,
            ]);

            Tugas::create([
                'nama' => 'Tugas Pemrograman',
                'deskripsi' => 'Buat aplikasi web',
                'deadline' => now()->addDays(10),
                'status' => 'sedang dikerjakan',
                'user_id' => $user->id,
                'kategori_id' => $kategoris->first()->id,
            ]);
        }
    }
}
