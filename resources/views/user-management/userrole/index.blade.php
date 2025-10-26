<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar UserRole</title>
</head>

<body>
    <h1>Daftar UserRole</h1>
    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    <a href="{{ route('userrole.create') }}">Tambah UserRole Baru</a>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>UserID</th>
                <th>RoleID</th>
                <th>Nama Employee</th>
                <th>Nama Parent</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($userRoles as $ur)
                <tr>
                    <td>{{ $ur->userid }}</td>
                    <td>{{ $ur->roleid }}</td>
                    <td>{{ $ur->employee ? $ur->employee->fullname : '-' }}</td>
                    <td>{{ $ur->parent ? $ur->parent->name : '-' }}</td>
                    <td>
                        <a href="{{ route('userrole.edit', $ur->userroleid) }}">Edit</a>
                        <form action="{{ route('userrole.destroy', $ur->userroleid) }}" method="POST"
                            style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
