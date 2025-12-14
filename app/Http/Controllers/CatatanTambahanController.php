<?php

namespace App\Http\Controllers;

use App\Models\CatatanTambahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CatatanTambahanController extends Controller
{
    /**
     * Menampilkan semua catatan milik user yang sedang login
     */
    public function index()
    {
        // Mengambil data hanya milik user yang login
        return response()->json(
            CatatanTambahan::where('user_id', Auth::id())->get()
        );
    }

    /**
     * Menyimpan catatan baru (Dengan Cek Libur Anti-Gagal)
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string',
            'isi'     => 'required|string',
            'tanggal' => 'required|date'
        ]);

        $libur = false;
        $tanggalInput = $request->tanggal; // Format: YYYY-MM-DD

        // 1. CEK MANUAL
        $daftarLiburManual = [
            '2024-12-25', '2025-12-25', '2026-12-25', // Natal
            '2024-01-01', '2025-01-01', '2026-01-01', // Tahun Baru
            '2024-08-17', '2025-08-17', '2026-08-17', // Kemerdekaan
            '2024-05-01', '2025-05-01', '2026-05-01', // Buruh
            '2024-06-01', '2025-06-01', '2026-06-01', // Pancasila
        ];

        if (in_array($tanggalInput, $daftarLiburManual)) {
            $libur = true;
        } 
        
        // 2. CEK API ONLINE (Hanya jika belum terdeteksi di atas)

        else {
            try {
                $tahun = date('Y', strtotime($tanggalInput));
                
                // Timeout dipercepat jadi 2 detik agar tidak loading lama
                $response = Http::timeout(2)->get('https://api-harilibur.vercel.app/api?year=' . $tahun);

                if ($response->successful()) {
                    foreach ($response->json() as $hari) {
                        if (isset($hari['holiday_date']) && $hari['holiday_date'] === $tanggalInput) {
                            $libur = true;
                            break;
                        }
                    }
                }
            } catch (\Exception $e) {
                
            }
        }

        // Simpan ke Database
        $catatan = CatatanTambahan::create([
            'user_id' => Auth::id(),
            'judul'   => $request->judul,
            'isi'     => $request->isi,
            'tanggal' => $request->tanggal,
            'libur'   => $libur
        ]);

        return response()->json([
            'message' => 'Catatan berhasil ditambahkan',
            'data' => $catatan
        ], 201);
    }

    /**
     * Menampilkan detail satu catatan
     */
    public function show(string $id)
    {
        $catatan = CatatanTambahan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return response()->json($catatan);
    }

    /**
     * Update catatan
     */
    public function update(Request $request, string $id)
    {
        $catatan = CatatanTambahan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $catatan->update($request->only([
            'judul',
            'isi',
            'tanggal'
        ]));

        return response()->json([
            'message' => 'Catatan berhasil diupdate',
            'data' => $catatan
        ]);
    }

    /**
     * Menghapus catatan
     */
    public function destroy(string $id)
    {
        $catatan = CatatanTambahan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
 
        $catatan->delete();

        return response()->json([
            'message' => 'Catatan berhasil dihapus'
        ]);
    }
}