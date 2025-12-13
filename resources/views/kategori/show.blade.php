@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Kategori: {{ $kategori->nama }}</h1>

    <div class="mb-3">
        <strong>Warna:</strong> <span style="color: {{ $kategori->warna ?? '#007bff' }};">{{ $kategori->warna ?? 'Default' }}</span>
    </div>

    <a href="{{ route('kategori.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Kategori</a>
    <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-warning mb-3">Edit Kategori</a>

    <h3>Kegiatan dalam Kategori Ini</h3>
    @if($kegiatans->count() > 0)
        <div class="row">
            @foreach($kegiatans as $kegiatan)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $kegiatan->nama }}</h5>
                            <p class="card-text">{{ $kegiatan->deskripsi }}</p>
                            <p class="card-text"><small class="text-muted">Tanggal: {{ $kegiatan->tanggal->format('d M Y') }}</small></p>
                            @if($kegiatan->waktu_mulai)
                                <p class="card-text"><small class="text-muted">Waktu: {{ $kegiatan->waktu_mulai }} - {{ $kegiatan->waktu_selesai }}</small></p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Tidak ada kegiatan dalam kategori ini.</p>
    @endif
</div>
@endsection