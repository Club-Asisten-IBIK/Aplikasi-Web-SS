<!DOCTYPE html>
<html>

<head>
    <title>Tambah Komponen Gaji</title>
</head>

<body>
    <h1>Tambah Komponen Gaji</h1>
    <form method="POST" action="{{ route('component-salary.store') }}">
        @csrf
        <label>Nama Komponen:</label>
        <input type="text" name="componentname" required>
        <button type="submit">Simpan</button>
    </form>
    <a href="{{ route('component-salary.index') }}">Kembali</a>
</body>

</html>
