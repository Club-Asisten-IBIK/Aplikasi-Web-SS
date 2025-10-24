<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Manajemen User</title>
</head>

<body>
    <h1>Daftar User</h1>

    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <p>
        <a href="{{ route('user.create') }}">Tambah User Baru</a>
    </p>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Tipe User</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                        @if ($user->employeeid)
                            Employee
                        @elseif($user->parentid)
                            Parent
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($user->employeeid)
                            {{ $user->employee_name }}
                        @elseif($user->parentid)
                            {{ $user->parent_name }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $user->isactive ? 'Aktif' : 'Tidak Aktif' }}</td>
                    <td>{{ $user->rolename ?? '-' }}</td>
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
                    <td colspan="7">Tidak ada data user.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
