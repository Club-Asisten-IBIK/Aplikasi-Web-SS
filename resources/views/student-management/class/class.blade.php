<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kelas</title>
</head>

<body>
    <h1>Daftar Kelas</h1>

    <button onclick="window.location='{{ route('class.create') }}'">Tambah Kelas</button>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Nama Kelas</th>
                <th>Grade</th>
                <th>Wali Kelas</th>
                <th>NIP</th>
                <th>Kapasitas</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classes as $class)
                <tr>
                    <td>{{ $class->classname }}</td>
                    <td>{{ $class->gradelevel }}</td>
                    <td>
                        {{ $class->guardian->employee->fullname ?? 'Tidak ada wali kelas' }}
                    </td>
                    <td>
                        {{ $class->guardian->employee->nip ?? '-' }}
                    </td>
                    <td>{{ $class->capacity }}</td>
                    <td>{{ $class->isactive ? 'Aktif' : 'Tidak Aktif' }}</td>
                    <td>
                        <button onclick="window.location='{{ route('class.edit', $class->classid) }}'">Edit</button>
                        <form action="{{ route('class.destroy', $class->classid) }}" method="POST"
                            style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus kelas ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
