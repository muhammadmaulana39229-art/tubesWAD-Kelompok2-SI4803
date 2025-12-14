@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Daftar Tugas</h2>
    <a href="{{ route('tugas.create') }}" class="btn btn-primary mb-3">Tambah Tugas</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tugas as $item)
            <tr>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->status }}</td>
                <td>
                    <a href="{{ route('tugas.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('tugas.destroy', ['tuga' => $item->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus tugas ini?')">
                            Hapus
                        </button>
                    </form>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
