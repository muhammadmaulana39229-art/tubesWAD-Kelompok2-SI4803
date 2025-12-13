@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Kegiatan Baru</h1>

    <form action="{{ route('kegiatan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kegiatan</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
            @error('tanggal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                <input type="time" class="form-control @error('waktu_mulai') is-invalid @enderror" id="waktu_mulai" name="waktu_mulai" value="{{ old('waktu_mulai') }}">
                @error('waktu_mulai')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                <input type="time" class="form-control @error('waktu_selesai') is-invalid @enderror" id="waktu_selesai" name="waktu_selesai" value="{{ old('waktu_selesai') }}">
                @error('waktu_selesai')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori (Opsional)</label>
            <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id">
                <option value="">Pilih Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                @endforeach
            </select>
            @error('kategori_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
