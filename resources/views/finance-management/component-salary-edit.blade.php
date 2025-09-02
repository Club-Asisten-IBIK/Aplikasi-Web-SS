<!DOCTYPE html>
<html>

<head>
    <title>Edit Komponen Gaji</title>
</head>

<body>
    <h1>Edit Komponen Gaji</h1>
    <form method="POST" action="{{ route('component-salary.update', $component->componentid) }}">
        @csrf
        @method('PUT')
        <label>Nama Komponen:</label>
        <input type="text" name="componentname" value="{{ $component->componentname }}" required>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('component-salary.index') }}">Kembali</a>
</body>

</html>
