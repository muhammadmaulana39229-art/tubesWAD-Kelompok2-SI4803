@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Kelola Kegiatan</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('kegiatan.create') }}" class="btn btn-primary mb-3">Tambah Kegiatan Baru</a>

    <div class="row">
        @forelse($kegiatans as $kegiatan)
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $kegiatan->nama }}</h5>
                        <p class="card-text">{{ $kegiatan->deskripsi }}</p>
                        <p class="card-text"><small class="text-muted">Tanggal: {{ $kegiatan->tanggal->format('d M Y') }}</small></p>
                        @if($kegiatan->waktu_mulai)
                            <p class="card-text"><small class="text-muted">Waktu: {{ $kegiatan->waktu_mulai }} - {{ $kegiatan->waktu_selesai }}</small></p>
                        @endif
                        @if($kegiatan->kategori)
                            <p class="card-text"><small class="text-muted">Kategori: <span style="color: {{ $kegiatan->kategori->warna ?? '#007bff' }};">{{ $kegiatan->kategori->nama }}</span></small></p>
                        @endif
                        <a href="{{ route('kegiatan.edit', $kegiatan) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kegiatan.destroy', $kegiatan) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus kegiatan ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>Tidak ada kegiatan.</p>
        @endforelse
    </div>
</div>
@endsection
