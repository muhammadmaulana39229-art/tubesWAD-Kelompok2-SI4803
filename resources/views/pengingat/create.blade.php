@extends('layouts.app') 

@section('title', 'Tambah Pengingat Baru')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2>🔔 Buat Pengingat Baru</h2>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pengingat.store') }}" method="POST">
                        @csrf 

                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Pengingat:</label>
                            <input type="text" 
                                class="form-control @error('judul') is-invalid @enderror" 
                                id="judul" 
                                name="judul" 
                                value="{{ old('judul') }}" 
                                required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="waktu_pengingat" class="form-label">Waktu Pengingat:</label>
                            <input type="datetime-local" 
                                class="form-control @error('waktu_pengingat') is-invalid @enderror" 
                                id="waktu_pengingat" 
                                name="waktu_pengingat" 
                                value="{{ old('waktu_pengingat') }}" 
                                required>
                            @error('waktu_pengingat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Waktu harus di masa depan.</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Tambahan (Opsional):</label>
                            <textarea 
                                class="form-control @error('deskripsi') is-invalid @enderror" 
                                id="deskripsi" 
                                name="deskripsi"
                                rows="3">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Simpan Pengingat</button>
                        <a href="{{ route('pengingat.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection