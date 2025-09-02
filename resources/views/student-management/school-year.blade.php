<!DOCTYPE html>
<html>

<head>
    <title>Daftar Tahun Ajaran</title>
</head>

<body>
    <h1>Daftar Tahun Ajaran</h1>
    <a href="{{ route('school-year.create') }}">Tambah Tahun Ajaran</a>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <table border="1" cellpadding="5">
        <tr>
            <th>No</th>
            <th>Tahun Ajaran</th>
            <th>Deskripsi</th>
            <th>Status Aktif</th>
            <th>Aksi</th>
        </tr>
        @foreach ($schoolyears as $index => $sy)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $sy->schoolyear }}</td>
                <td>{{ $sy->desc }}</td>
                <td>{{ $sy->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>
                <td>
                    <a href="{{ route('school-year.edit', $sy->schoolyearid) }}">Edit</a>
                    <form action="{{ route('school-year.destroy', $sy->schoolyearid) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
