<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kegiatan;
use App\Models\Tugas;
use App\Models\Pengingat;
use Illuminate\Support\Facades\Http; // Untuk memanggil API eksternal

class DashboardController extends Controller
{
    // Method index untuk menampilkan Dashboard
    public function index()
    {
        $user = Auth::user();

        // 1. Data Tugas & Kegiatan (5 Terdekat)
        $tugas_mendatang = $user->tugas()->orderBy('tenggat_waktu', 'asc')->take(5)->get();
        $kegiatan_mendatang = $user->kegiatans()->orderBy('waktu_mulai', 'asc')->take(5)->get();

        // 2. Logika Notifikasi Pengingat (Dari Modul Muhammad Maulana)
        $notifikasi_baru = Pengingat::where('user_id', auth()->id())
            ->where('status_muncul', 0)
            ->orderBy('waktu_pengingat', 'asc')
            ->limit(5)
            ->get();


        // Tandai pengingat tersebut sebagai sudah muncul (Agar tidak muncul lagi)
        if ($notifikasi_baru->isNotEmpty()) {
            Pengingat::whereIn('id', $notifikasi_baru->pluck('id'))->update(['status_muncul' => true]);
        }

        // 3. Integrasi API Hari Libur (Dari Modul Lucky Thezavanica)
        $hari_libur = [];
        try {
            // Ganti URL ini dengan API Kalender Nasional yang sebenarnya
            $response = Http::get('https://api.example.com/kalender/hari-libur-2025'); 
            
            if ($response->successful()) {
                $hari_libur = $response->json();
            }
        } catch (\Exception $e) {
            // Tangani kegagalan API jika diperlukan
            // Misalnya, $hari_libur = ['error' => 'Gagal mengambil data hari libur.'];
        }

        return view('auth.dashboard', compact(
            'notifikasi_baru',
            'tugas_mendatang',
            'kegiatan_mendatang',
            'hari_libur'
        ));
    }
}
