<h1>Daftar Kegiatan Mahasiswa</h1>

<a href="{{ route('kegiatan.create') }}">+ Tambah Kegiatan</a>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Tanggal</th>
            <th>Lokasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($kegiatan as $index => $k)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $k->judul }}</td>
                <td>{{ $k->tanggal }}</td>
                <td>{{ $k->lokasi }}</td>
                <td>
                    <a href="{{ route('kegiatan.show', $k->id) }}">Detail</a> |
                    <a href="{{ route('kegiatan.edit', $k->id) }}">Edit</a>

                    <form action="{{ route('kegiatan.destroy', $k->id) }}"
                          method="POST"
                          style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Yakin ingin menghapus kegiatan ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Belum ada kegiatan.</td>
            </tr>
        @endforelse
    </tbody>
</table>