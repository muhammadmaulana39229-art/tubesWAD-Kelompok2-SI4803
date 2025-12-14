<h1>Tambah Kegiatan Mahasiswa</h1>

<form action="{{ route('kegiatan.store') }}" method="POST">
    @csrf

    <div>
        <label>Judul Kegiatan</label><br>
        <input type="text" name="judul" required>
    </div>

    <br>

    <div>
        <label>Deskripsi</label><br>
        <textarea name="deskripsi" rows="4"></textarea>
    </div>

    <br>

    <div>
        <label>Tanggal</label><br>
        <input type="date" name="tanggal" required>
    </div>

    <br>

    <div>
        <label>Waktu</label><br>
        <input type="time" name="waktu">
    </div>

    <br>

    <div>
        <label>Lokasi</label><br>
        <input type="text" name="lokasi">
    </div>

    <br>

    <button type="submit">Simpan</button>
    <a href="{{ route('kegiatan.index') }}">Batal</a>
</form>

