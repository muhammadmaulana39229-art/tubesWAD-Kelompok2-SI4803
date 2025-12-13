<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kegiatans = Kegiatan::where('user_id', auth()->id())->with('kategori')->latest()->get();
        return view('kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        $kategoris = Kategori::where('user_id', auth()->id())->get();
        return view('kegiatan.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i',
            'kategori_id' => 'nullable|exists:kategoris,id',
        ]);

        auth()->user()->kegiatans()->create($request->all());

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function show(Kegiatan $kegiatan)
    {
        $this->authorize('view', $kegiatan);
        return view('kegiatan.show', compact('kegiatan'));
    }

    public function edit(Kegiatan $kegiatan)
    {
        $this->authorize('update', $kegiatan);
        $kategoris = Kategori::where('user_id', auth()->id())->get();
        return view('kegiatan.edit', compact('kegiatan', 'kategoris'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $this->authorize('update', $kegiatan);

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i',
            'kategori_id' => 'nullable|exists:kategoris,id',
        ]);

        $kegiatan->update($request->all());

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diubah.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $this->authorize('delete', $kegiatan);
        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}
