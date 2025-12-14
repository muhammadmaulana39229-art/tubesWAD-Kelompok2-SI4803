<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;

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
        return view('kegiatan.create');
    }

    public function store(Request $request)
    {
        Kegiatan::create($request->all());

        return redirect()->route('kegiatan.index');
    }

    public function show(Kegiatan $kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        return view('kegiatan.show', compact('kegiatan'));
    }

    public function edit(Kegiatan $kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        return view('kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->update($request->all());

        return redirect()->route('kegiatan.index');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        Kegiatan::destroy($id);

        return redirect()->route('kegiatan.index');
    }
}