@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Kelola Kategori</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">Tambah Kategori Baru</a>

    <div class="row">
        @forelse($kategoris as $kategori)
            <div class="col-md-4 mb-3">
                <div class="card" style="border-left: 5px solid {{ $kategori->warna ?? '#007bff' }};">
                    <div class="card-body">
                        <h5 class="card-title">{{ $kategori->nama }}</h5>
                        <p class="card-text">Warna: <span style="color: {{ $kategori->warna ?? '#007bff' }};">{{ $kategori->warna ?? 'Default' }}</span></p>
                        <p class="card-text">Jumlah Kegiatan: {{ $kategori->kegiatans->count() }}</p>
                        <a href="{{ route('kategori.show', $kategori) }}" class="btn btn-info btn-sm">Lihat Kegiatan</a>
                        <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus kategori ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>Tidak ada kategori.</p>
        @endforelse
    </div>
</div>
@endsection
