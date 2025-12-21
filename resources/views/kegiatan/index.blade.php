@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">📅 Daftar Kegiatan Mahasiswa</h5>
            <a href="{{ route('kegiatan.create') }}" class="btn btn-primary btn-sm">
                + Tambah Kegiatan
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kegiatan as $i => $k)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $k->judul }}</td>
                            <td>{{ $k->tanggal }}</td>
                            <td>{{ $k->lokasi }}</td>
                            <td>
                                <a href="{{ route('kegiatan.show', $k->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('kegiatan.edit', $k->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('kegiatan.destroy', $k->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus kegiatan ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Belum ada kegiatan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection