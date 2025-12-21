<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kegiatan;
use App\Models\Tugas;
use App\Models\Pengingat;
use App\Models\CatatanTambahan;
use App\Models\Kategori;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Ambil 5 Tugas Pending
        $tugas_mendatang = $user->tugas()
            ->with('kategori')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        // 2. Ambil 5 Kegiatan Terbaru
        $kegiatan = $user->kegiatans()
            ->with('kategori')
            ->latest()
            ->take(5)
            ->get();

        $kategoris = $user->kategoris()
             ->withCount(['tugas', 'kegiatans'])
             ->get();

        $pengingats = $user->pengingats()
            ->where('waktu_pengingat', '>=', Carbon::now()) // Munculkan yang belum lewat
            ->orderBy('waktu_pengingat', 'asc')
            ->take(5)
            ->get();

        // 3. Ambil 5 Catatan Tambahan Terbaru (Sesuai model Anda)
        $catatan_tambahan = $user->catatans()
            ->latest()
            ->take(5)
            ->get();

        // 4. Logika Notifikasi Pengingat (Hanya muncul jika sudah waktunya)
        $notifikasi_baru = $user->pengingats()
            ->where('status_muncul', false)
            ->where('waktu_pengingat', '<=', Carbon::now())
            ->get();

        if ($notifikasi_baru->isNotEmpty()) {
            $user->pengingats()
                ->whereIn('id', $notifikasi_baru->pluck('id'))
                ->update(['status_muncul' => true]);
        }

        // 5. API Hari Libur Nasional (Untuk info di sidebar/card)
        $hari_libur = [];
        try {
            $response = Http::timeout(3)->get('https://api-harilibur.vercel.app/api'); 
            if ($response->successful()) {
                $hari_libur = array_slice($response->json(), 0, 5); // Ambil 5 hari libur terdekat
            }
        } catch (\Exception $e) {
            $hari_libur = [];
        }

        return view('auth.dashboard', compact(
            'notifikasi_baru',
            'tugas_mendatang',
            'kegiatan',
            'catatan_tambahan',
            'kategoris',
            'hari_libur',
            'pengingats'
        ));
    }
}