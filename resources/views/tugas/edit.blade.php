@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Tugas</h2>

    <form action="{{ route('tugas.update', ['tuga' => $tugas->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $tugas->judul }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $tugas->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="pending" {{ $tugas->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="proses" {{ $tugas->status == 'proses' ? 'selected' : '' }}>Proses</option>
                <option value="selesai" {{ $tugas->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('tugas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
