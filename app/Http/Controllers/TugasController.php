<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::all();
        return view('tugas.index', compact('tugas'));
    }

    public function create()
    {
        return view('tugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
        ]);

        Tugas::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => 'pending',
        ]);

        return redirect()->route('tugas.index')
            ->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function edit(Tugas $tuga)
    {
        return view('tugas.edit', [
            'tugas' => $tuga
        ]);
    }

    public function update(Request $request, Tugas $tuga)
    {
        $request->validate([
            'judul' => 'required',
        ]);

        $tuga->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
        ]);

        return redirect()->route('tugas.index')
            ->with('success', 'Tugas berhasil diperbarui!');
    }

    public function destroy(Tugas $tuga)
    {
        $tuga->delete();

        return redirect()->route('tugas.index')
            ->with('success', 'Tugas berhasil dihapus!');
    }
}
