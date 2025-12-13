@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Kategori</h1>

    <form action="{{ route('kategori.update', $kategori) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $kategori->nama) }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="warna" class="form-label">Warna (Hex Code, contoh: #007bff)</label>
            <input type="color" class="form-control @error('warna') is-invalid @enderror" id="warna" name="warna" value="{{ old('warna', $kategori->warna ?? '#007bff') }}">
            @error('warna')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection