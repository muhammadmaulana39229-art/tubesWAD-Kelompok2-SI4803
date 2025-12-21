@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5>📄 Detail Kegiatan</h5>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="200">Judul</th>
                    <td>{{ $kegiatan->judul }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $kegiatan->deskripsi }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>{{ $kegiatan->tanggal }}</td>
                </tr>
                <tr>
                    <th>Waktu</th>
                    <td>{{ $kegiatan->waktu }}</td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td>{{ $kegiatan->lokasi }}</td>
                </tr>
            </table>

            <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">
                ⬅ Kembali
            </a>
            <a href="{{ route('kegiatan.edit', $kegiatan->id) }}" class="btn btn-warning">
                ✏ Edit
            </a>
        </div>
    </div>
</div>
@endsection