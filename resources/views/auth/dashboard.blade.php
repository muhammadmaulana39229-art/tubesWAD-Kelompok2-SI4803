@extends('layouts.app') 

@section('title', 'Dashboard Mahasiswa NotiX')

@section('content')

<div class="container mt-4">
    <h1 class="mb-4">Selamat Datang, {{ Auth::user()->name }}!</h1>

    {{-- Alert Pengingat Baru --}}
    @if(isset($notifikasi_baru) && $notifikasi_baru->count())
        <div class="alert alert-danger shadow-sm border-0" role="alert">
            <h4 class="fw-bold">🔔 Anda memiliki {{ $notifikasi_baru->count() }} Pengingat Baru!</h4>
            <ul class="list-unstyled mb-0">
                @foreach($notifikasi_baru as $notif)
                    <li><strong>{{ $notif->judul }}</strong> - {{ \Carbon\Carbon::parse($notif->waktu_pengingat)->translatedFormat('d F Y, H:i') }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        {{-- Kolom Kiri: Kategori (Dibuat col-md-8 agar lebih luas) --}}
        <div class="col-md-8 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-primary text-white fw-bold py-3">
                    <h5 class="mb-0">🏷️ Ringkasan Kategori</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($kategoris as $kat)
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('kategori.show', $kat->id) }}" class="text-decoration-none">
                                    <div class="card shadow-sm border-0 h-100" style="border-left: 5px solid {{ $kat->warna ?? '#6c757d' }} !important;">
                                        <div class="card-header text-white small py-1" style="background-color: {{ $kat->warna ?? '#6c757d' }};">
                                            {{ $kat->nama }} (Klik untuk Detail)
                                        </div>
                                        <div class="card-body py-2">
                                            <h3 class="fw-bold mb-0 text-dark">{{ $kat->tugas_count + $kat->kegiatans_count }}</h3>
                                            <small class="text-muted">Total Item</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12 text-muted italic text-center py-4">Belum ada kategori.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Pengingat Aktif (Menggantikan posisi Catatan) --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-danger text-white fw-bold py-3">
                    <h5 class="mb-0">🔔 Pengingat Aktif</h5>
                </div>
                <div class="card-body">
                    @forelse($pengingats ?? [] as $p)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <div>
                                <strong class="d-block text-dark small">{{ $p->judul }}</strong>
                                <small class="text-muted">
                                    ⏰ {{ \Carbon\Carbon::parse($p->waktu_pengingat)->format('d M, H:i') }}
                                </small>
                            </div>
                            <span class="badge bg-light text-dark border small">Aktif</span>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <p class="text-muted small italic">Tidak ada pengingat aktif.</p>
                        </div>
                    @endforelse
                    <div class="mt-3">
                        <a href="{{ route('pengingat.index') }}" class="btn btn-sm btn-outline-danger w-100">Kelola Semua Pengingat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Kolom: Tugas Mendatang --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-warning text-dark fw-bold py-3">
                    <h5 class="mb-0">📌 Tugas Mendatang</h5>
                </div>
                <div class="card-body">
                    @if($tugas_mendatang->isNotEmpty())
                        <ul class="list-group list-group-flush">
                            @foreach($tugas_mendatang as $tugas)
                                <li class="list-group-item d-flex justify-content-between align-items-start px-0 border-0 border-bottom">
                                    <div>
                                        <span class="d-block fw-bold text-dark">{{ $tugas->judul }}</span>
                                        @if($tugas->kategori)
                                            <span class="badge" style="background-color: {{ $tugas->kategori->warna ?? '#6c757d' }}; color: white;">
                                                {{ $tugas->kategori->nama }}
                                            </span>
                                        @endif
                                    </div>
                                    <span class="badge bg-light text-dark border">{{ \Carbon\Carbon::parse($tugas->tenggat_waktu)->diffForHumans() }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-3 text-end">
                            <a href="{{ route('tugas.index') }}" class="btn btn-sm btn-outline-warning">Lihat Semua Tugas</a>
                        </div>
                    @else
                        <p class="text-muted text-center py-4">Tidak ada tugas yang tercatat.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Kolom: Kegiatan Akademik/Non-Akademik --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-success text-white fw-bold py-3">
                    <h5 class="mb-0">🗓️ Kegiatan Mendatang</h5>
                </div>
                <div class="card-body">
                    @if($kegiatan->isNotEmpty())
                        <ul class="list-group list-group-flush">
                            @foreach($kegiatan as $keg)
                                <li class="list-group-item d-flex justify-content-between align-items-start px-0 border-0 border-bottom">
                                    <div>
                                        <span class="d-block fw-bold text-dark">{{ $keg->judul }}</span>
                                        @if($keg->kategori)
                                            <span class="badge" style="background-color: {{ $keg->kategori->warna ?? '#17a2b8' }}; color: white;">
                                                {{ $keg->kategori->nama }}
                                            </span>
                                        @endif
                                    </div>
                                    <small class="text-muted fw-bold">{{ \Carbon\Carbon::parse($keg->tanggal)->format('d M') }}</small>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-3 text-end">
                            <a href="{{ route('kegiatan.index') }}" class="btn btn-sm btn-outline-success">Lihat Semua Kegiatan</a>
                        </div>
                    @else
                        <p class="text-muted text-center py-4">Tidak ada kegiatan tercatat.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Baris Bawah: Hari Libur (Full Width/Center) --}}
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            <div class="card shadow border-0">
                <div class="card-header bg-secondary text-white fw-bold text-center">
                    ℹ️ Hari Libur Resmi
                </div>
                <div class="card-body">
                    @if(isset($hari_libur) && count($hari_libur) > 0)
                        <div class="row">
                            @foreach($hari_libur as $libur)
                                <div class="col-md-4 col-sm-6 mb-2 d-flex align-items-center">
                                    <span class="badge bg-danger me-2" style="width: 60px;">
                                        {{ \Carbon\Carbon::parse($libur['holiday_date'])->format('d M') }}
                                    </span> 
                                    <small class="text-dark fw-bold">{{ $libur['holiday_name'] }}</small>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-muted">Tidak ada data hari libur tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection