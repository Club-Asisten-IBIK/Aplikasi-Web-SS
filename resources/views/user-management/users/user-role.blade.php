<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Role Management</title>
</head>

<body>
    <h1>Daftar User Role</h1>

    <!-- Tampilkan pesan sukses -->
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <!-- Form tambah user-role -->
    <h2>Tambah User Role</h2>
    <form method="POST" action="{{ route('user-role.store') }}">
        @csrf
        <label>User:</label>
        <select name="userid" required>
            <option value="">Pilih User</option>
            @foreach ($users as $user)
                <option value="{{ $user->userid }}">{{ $user->username }}</option>
            @endforeach
        </select>
        <label>Role:</label>
        <select name="roleid" required>
            <option value="">Pilih Role</option>
            @foreach ($roles as $role)
                <option value="{{ $role->roleid }}">{{ $role->rolename }}</option>
            @endforeach
        </select>
        <button type="submit">Tambah</button>
    </form>

    <hr>

    <!-- Tabel user-role -->
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userRoles as $index => $ur)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $ur->username }}</td>
                    <td>{{ $ur->rolename }}</td>
                    <td>
                        <!-- Form Edit User Role -->
                        <form method="POST" action="{{ route('user-role.update', $ur->userid) }}"
                            style="display:inline;">
                            @csrf
                            @method('PUT')
                            <select name="roleid" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->roleid }}"
                                        {{ $ur->roleid == $role->roleid ? 'selected' : '' }}>
                                        {{ $role->rolename }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit">Edit</button>
                        </form>
                        <!-- Form Hapus User Role -->
                        <form method="POST" action="{{ route('user-role.destroy', $ur->userid) }}"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
