@extends('layouts.app') 

@section('title', 'Dashboard Mahasiswa NotiX')

@section('content')

<div class="container mt-4">

     <h1 class="mb-4">Selamat Datang, {{ Auth::user()->name }}!</h1>

    @if($notifikasi_baru->count())
        <div class="alert alert-danger" role="alert">
            <h4>🔔 Anda memiliki {{ $notifikasi_baru->count() }} Pengingat Baru!</h4>
            <ul class="list-unstyled">
                @foreach($notifikasi_baru as $notif)
                    <li><strong>{{ $notif->judul }}</strong> {{ \Carbon\Carbon::parse($notif->waktu_pengingat)->translatedFormat('d F Y, H:i') }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h5>📌 Tugas Mendatang</h5>
                </div>
                <div class="card-body">
                    @if($tugas_mendatang->isNotEmpty())
                        <ul class="list-group list-group-flush">
                            @foreach($tugas_mendatang as $tugas)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $tugas->judul }}
                                    <span class="badge bg-secondary">{{ \Carbon\Carbon::parse($tugas->tenggat_waktu)->diffForHumans() }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-3 text-end">
                            <a href="{{ route('tugas.index') }}" class="card-link">Lihat Semua Tugas &raquo;</a>
                        </div>
                    @else
                        <p class="text-muted">Tidak ada tugas yang tercatat.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5>🗓️ Kegiatan Akademik/Non-Akademik Terdekat</h5>
                </div>
                <div class="card-body">
                    @if($kegiatan_mendatang->isNotEmpty())
                        <ul class="list-group list-group-flush">
                            @foreach($kegiatan_mendatang as $kegiatan)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $kegiatan->nama_kegiatan }}
                                    <span class="badge bg-info">{{ \Carbon\Carbon::parse($kegiatan->waktu_mulai)->format('d M, H:i') }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-3 text-end">
                            <a href="{{ route('kegiatan.index') }}" class="card-link">Lihat Semua Kegiatan &raquo;</a>
                        </div>
                    @else
                        <p class="text-muted">Tidak ada kegiatan yang tercatat.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5>ℹ️ Hari Libur Resmi</h5>
                </div>
                <div class="card-body">
                    @if(isset($hari_libur) && count($hari_libur) > 0)
                        <div class="row">
                            @foreach($hari_libur as $libur)
                                <div class="col-md-4 mb-2">
                                    <span class="badge bg-danger">{{ $libur['tanggal'] }}</span> 
                                    {{ $libur['nama'] }}
                                </div>
                            @endforeach
                        </div>
                        <small class="text-muted">Data diambil dari API Kalender Nasional.</small>
                    @elseif(isset($hari_libur['error']))
                        <p class="text-danger">Gagal memuat hari libur: {{ $hari_libur['error'] }}</p>
                    @else
                        <p class="text-muted">Tidak ada data hari libur yang tersedia saat ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection