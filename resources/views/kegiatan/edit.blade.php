@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5>✏ Edit Kegiatan</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Judul Kegiatan</label>
                    <input type="text" name="judul" class="form-control"
                           value="{{ $kegiatan->judul }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control">{{ $kegiatan->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control"
                           value="{{ $kegiatan->tanggal }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Waktu</label>
                    <input type="time" name="waktu" class="form-control"
                           value="{{ $kegiatan->waktu }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control"
                           value="{{ $kegiatan->lokasi }}">
                </div>

                <button class="btn btn-warning">Update</button>
                <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection