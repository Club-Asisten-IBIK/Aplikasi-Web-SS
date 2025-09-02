<!DOCTYPE html>
<html>

<head>
    <title>Edit Tahun Ajaran</title>
</head>

<body>
    <h1>Edit Tahun Ajaran</h1>
    <form method="POST" action="{{ route('school-year.update', $schoolyear->schoolyearid) }}">
        @csrf
        @method('PUT')
        <label>Tahun Ajaran:</label>
        <input type="text" name="schoolyear" value="{{ $schoolyear->schoolyear }}" required><br>
        <label>Deskripsi:</label>
        <input type="text" name="desc" value="{{ $schoolyear->desc }}"><br>
        <label>Status Aktif:</label>
        <select name="is_active" required>
            <option value="1" {{ $schoolyear->is_active ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ !$schoolyear->is_active ? 'selected' : '' }}>Tidak Aktif</option>
        </select><br>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('school-year.index') }}">Kembali</a>
</body>

</html>
