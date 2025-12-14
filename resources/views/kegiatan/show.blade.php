<h1>Detail Kegiatan Mahasiswa</h1>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Judul</th>
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

<br>

<a href="{{ route('kegiatan.index') }}">Kembali</a>
|
<a href="{{ route('kegiatan.edit', $kegiatan->id) }}">Edit</a>