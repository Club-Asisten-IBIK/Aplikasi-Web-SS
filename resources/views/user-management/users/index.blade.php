<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar User</title>
</head>

<body>
    <h1>Daftar User</h1>
    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    <a href="{{ route('user.create') }}">Tambah User Baru</a>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->isactive ? 'Aktif' : 'Tidak Aktif' }}</td>
                    <td>
                        <a href="{{ route('user.edit', $user->userid) }}">Edit</a>
                        <form action="{{ route('user.destroy', $user->userid) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Tidak ada data user.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
