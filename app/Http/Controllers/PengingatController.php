<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengingatStoreRequest;
use Illuminate\Http\Request;
use App\Models\Pengingat;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class PengingatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua pengingat milik pengguna yang sedang login, diurutkan berdasarkan waktu terdekat
        $pengingats = Auth::user()
            ->pengingats()
            ->orderBy('waktu_pengingat', 'asc')
            ->get();

            // Tampilkan view daftar pengingat
        return view('pengingat.index', compact('pengingats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan view formulir tambah pengingat baru
        return view('pengingat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(PengingatStoreRequest $request)
    {
        // 1. Validasi dilakukan otomatis oleh PengingatStoreRequest, termasuk 'after_or_equal:now'
        $validatedData = $request->validated();
        
        // 2. Tambahkan user_id dari user yang sedang login
        $validatedData['user_id'] = Auth::id();
        // 3. Simpan ke database
        Pengingat::create($validatedData);

        // 4. Redirect ke halaman daftar dengan pesan sukses
        return redirect()->route('pengingat.index')->with('success', 'Pengingat baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Cari pengingat berdasarkan ID dan pastikan itu milik pengguna yang login
        $pengingat = Auth::user()->pengingats()->findOrFail($id);
        
        // Tampilkan detail pengingat
        return view('pengingat.show', compact('pengingat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Cari pengingat berdasarkan ID dan pastikan itu milik pengguna yang login
        $pengingat = Auth::user()->pengingats()->findOrFail($id);
        
        // Tampilkan formulir edit
        return view('pengingat.edit', compact('pengingat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Cari dan pastikan pengingat milik pengguna
        $pengingat = Auth::user()->pengingats()->findOrFail($id);

        // 2. Validasi Input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'waktu_pengingat' => 'required|date', 
        ]);
        
        // 3. Update data, reset status muncul agar pengingat bisa muncul lagi
        $pengingat->update(array_merge($validated, ['status_muncul' => false]));

        // 4. Redirect
        return redirect()->route('pengingat.index')->with('success', 'Pengingat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. Cari dan pastikan pengingat milik pengguna
        $pengingat = Auth::user()->pengingats()->findOrFail($id);
        
        // 2. Hapus dari database
        $pengingat->delete();

        // 3. Redirect
        return redirect()->route('pengingat.index')->with('success', 'Pengingat berhasil dihapus.');
    }
}
