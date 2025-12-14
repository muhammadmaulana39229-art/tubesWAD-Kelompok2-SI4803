<?php
namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Otorisasi menggunakan KategoriPolicy
        $this->authorizeResource(Kategori::class, 'kategori');
    }

    public function index()
    {
        // Hanya ambil kategori milik user yang sedang login
        $kategoris = Kategori::where('user_id', auth()->id())->with(['kegiatans', 'tugas'])->latest()->get();
        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(StoreKategoriRequest $request)
    {
        auth()->user()->kategoris()->create($request->validated());

        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori)
    {
        // Otorisasi sudah ditangani oleh Policy
        return view('kategori.edit', compact('kategori'));
    }

    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        $kategori->update($request->validated());

        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori berhasil diubah.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori berhasil dihapus.');
    }

    public function show(Kategori $kategori)
    {
        // Otorisasi sudah ditangani oleh Policy
        $kegiatans = $kategori->kegiatans()->latest()->get();
        $tugas = $kategori->tugas()->latest()->get(); // Tambah tugas
        return view('kategori.show', compact('kategori', 'kegiatans', 'tugas'));
    }
}