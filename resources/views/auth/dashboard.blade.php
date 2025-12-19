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
                                <li class="list-group-item d-flex justify-content-between align-items-start px-0">
                                    <div>
                                        <span class="d-block fw-bold">{{ $tugas->judul }}</span>
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
                    @if($kegiatan->isNotEmpty())
                        <ul class="list-group list-group-flush">
                            @foreach($kegiatan as $keg)
                                <li class="list-group-item d-flex justify-content-between align-items-start px-0">
                                    <div>
                                        <span class="d-block fw-bold">{{ $keg->judul }}</span>
                                        @if($keg->kategori)
                                            <span class="badge" style="background-color: {{ $keg->kategori->warna ?? '#17a2b8' }}; color: white;">
                                                {{ $keg->kategori->nama }}
                                            </span>
                                        @endif
                                    </div>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($keg->tanggal)->format('d M') }}</small>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-3 text-end">
                            <a href="{{ route('kegiatan.index') }}" class="btn btn-sm btn-outline-success">Lihat Semua Kegiatan</a>
                        </div>
                    @else
                        <p class="text-muted">Tidak ada kegiatan tercatat.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h5>📝 Catatan Terbaru</h5>
                </div>
                <div class="card-body">
                    @if(isset($catatan_tambahan) && $catatan_tambahan->isNotEmpty())
                        <ul class="list-group list-group-flush">
                            @foreach($catatan_tambahan as $catatan)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <strong>{{ $catatan->judul }}</strong>
                                        @if($catatan->libur)
                                            <span class="badge bg-success">Libur</span>
                                        @endif
                                    </div>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($catatan->tanggal)->format('d M Y') }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Belum ada catatan tambahan.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5>ℹ️ Hari Libur Resmi</h5>
                </div>
                <div class="card-body">
                    @if(isset($hari_libur) && count($hari_libur) > 0)
                        <div class="row">
                            @foreach($hari_libur as $libur)
                                <div class="col-md-12 mb-2">
                                    <span class="badge bg-danger">
                                        {{ \Carbon\Carbon::parse($libur['holiday_date'])->format('d M') }}
                                    </span> 
                                    <small>{{ $libur['holiday_name'] }}</small>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <small class="text-muted">Data otomatis dari API Nasional.</small>
                    @else
                        <p class="text-muted">Tidak ada data hari libur tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection