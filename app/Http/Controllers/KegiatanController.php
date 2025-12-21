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
        $kegiatan = Kegiatan::all();
        return view('kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        $kategoris = Kategori::where('user_id', auth()->id())->get();
        return view('kegiatan.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'judul' => 'required',
        'tanggal' => 'required',
        'waktu' => 'required',
        'kategori_id' => 'required|exists:kategoris,id',
        
    ]);

    $data = $request->all();
    $data['user_id'] = auth()->id();
    $data['kategori_id'] = $request->kategori_id;

    Kegiatan::create($data);

    return redirect()->route('kegiatan.index');
    }

    public function show(Kegiatan $kegiatan)
    {
        return view('kegiatan.show', compact('kegiatan'));
    }

    public function edit(Kegiatan $kegiatan)
    {
        $kategoris = Kategori::where('user_id', auth()->id())->get();

        return view('kegiatan.edit', compact('kegiatan', 'kategoris'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->update($request->all());

        return redirect()->route('kegiatan.index');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();

        return redirect()->route('kegiatan.index');
    }
}