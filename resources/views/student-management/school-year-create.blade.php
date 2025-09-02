<!DOCTYPE html>
<html>

<head>
    <title>Tambah Tahun Ajaran</title>
</head>

<body>
    <h1>Tambah Tahun Ajaran</h1>
    <form method="POST" action="{{ route('school-year.store') }}">
        @csrf
        <label>Tahun Ajaran:</label>
        <input type="text" name="schoolyear" required><br>
        <label>Deskripsi:</label>
        <input type="text" name="desc"><br>
        <label>Status Aktif:</label>
        <select name="is_active" required>
            <option value="1">Aktif</option>
            <option value="0">Tidak Aktif</option>
        </select><br>
        <button type="submit">Simpan</button>
    </form>
    <a href="{{ route('school-year.index') }}">Kembali</a>
</body>

</html>
