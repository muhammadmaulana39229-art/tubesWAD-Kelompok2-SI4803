@extends('layouts.app') 

@section('title', 'Daftar Pengingat')

@section('content')
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <h1>Daftar Pengingat</h1>
            <a href="{{ route('pengingat.create') }}" class="btn btn-primary">
                + Tambah Pengingat
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($pengingats->isNotEmpty())
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Waktu Pengingat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengingats as $index => $pengingat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $pengingat->judul }}</strong>
                                <p class="text-muted small mb-0">{{ Str::limit($pengingat->deskripsi, 50) }}</p>
                            </td>
                            <td>
                                {{ $pengingat->waktu_pengingat->format('d M Y, H:i') }}
                            </td>
                            <td>
                                @if($pengingat->waktu_pengingat->isPast() && $pengingat->status_muncul)
                                    <span class="badge bg-success">Sudah Dilihat</span>
                                @elseif($pengingat->waktu_pengingat->isPast() && !$pengingat->status_muncul)
                                    <span class="badge bg-warning text-dark">Belum Dilihat</span>
                                @else
                                    <span class="badge bg-info">Menunggu</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('pengingat.edit', $pengingat->id) }}" class="btn btn-sm btn-warning text-white me-2">
                                    Edit
                                </a>
                                
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $pengingat->id }}">
                                    Hapus
                                </button>
                                
                                @include('pengingat.delete-modal', ['pengingat' => $pengingat])
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            Anda belum memiliki pengingat yang tercatat.
        </div>
    @endif
</div>
@endsection