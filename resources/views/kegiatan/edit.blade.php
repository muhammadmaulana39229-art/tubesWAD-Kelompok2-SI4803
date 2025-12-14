<h1>Edit Kegiatan Mahasiswa</h1>

<form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Judul Kegiatan</label><br>
        <input type="text" name="judul" value="{{ $kegiatan->judul }}" required>
    </div>

    <br>

    <div>
        <label>Deskripsi</label><br>
        <textarea name="deskripsi" rows="4">{{ $kegiatan->deskripsi }}</textarea>
    </div>

    <br>

    <div>
        <label>Tanggal</label><br>
        <input type="date" name="tanggal" value="{{ $kegiatan->tanggal }}" required>
    </div>

    <br>

    <div>
        <label>Waktu</label><br>
        <input type="time" name="waktu" value="{{ $kegiatan->waktu }}">
    </div>

    <br>

    <div>
        <label>Lokasi</label><br>
        <input type="text" name="lokasi" value="{{ $kegiatan->lokasi }}">
    </div>

    <br>

    <button type="submit">Update</button>
    <a href="{{ route('kegiatan.index') }}">Batal</a>
</form>
