<!DOCTYPE html>
<html>

<head>
    <title>Daftar Komponen Gaji</title>
</head>

<body>
    <h1>Daftar Komponen Gaji</h1>
    <a href="{{ route('component-salary.create') }}">Tambah Komponen</a>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <table border="1" cellpadding="5">
        <tr>
            <th>No</th>
            <th>Nama Komponen</th>
            <th>Aksi</th>
        </tr>
        @foreach ($components as $index => $component)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $component->componentname }}</td>
                <td>
                    <a href="{{ route('component-salary.edit', $component->componentid) }}">Edit</a>
                    <form action="{{ route('component-salary.destroy', $component->componentid) }}" method="POST"
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
