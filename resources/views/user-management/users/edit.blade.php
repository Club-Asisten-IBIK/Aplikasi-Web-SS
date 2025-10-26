<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>

<body>
    <h1>Edit User</h1>
    <a href="{{ route('user.index') }}">Kembali ke Daftar</a>
    <hr>
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('user.update', $user->userid) }}" method="POST">
        @csrf
        @method('PUT')
        <p>
            <label for="username">Username</label><br>
            <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required
                maxlength="50">
        </p>
        <p>
            <label for="password">Password (kosongkan jika tidak ingin mengubah)</label><br>
            <input type="password" name="password" id="password" minlength="6">
        </p>
        <p>
            <label>Status Aktif</label><br>
            <select name="isactive" required>
                <option value="1" {{ old('isactive', $user->isactive) == '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('isactive', $user->isactive) == '0' ? 'selected' : '' }}>Tidak Aktif
                </option>
            </select>
        </p>
        <p>
            <button type="submit">Update</button>
        </p>
    </form>
</body>

</html>
