<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah User Baru</title>
</head>

<body>
    <h1>Tambah User Baru</h1>
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

    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <p>
            <label for="username">Username</label><br>
            <input type="text" name="username" id="username" value="{{ old('username') }}" required maxlength="50">
        </p>
        <p>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" required minlength="6">
        </p>
        <p>
            <label>Status Aktif</label><br>
            <select name="isactive" required>
                <option value="1" {{ old('isactive') == '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('isactive') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </p>
        <p>
            <label for="type">Tipe User</label><br>
            <select name="type" id="type" required onchange="toggleUserType()">
                <option value="">-- Pilih Tipe --</option>
                <option value="employee" {{ old('type') == 'employee' ? 'selected' : '' }}>Employee</option>
                <option value="parent" {{ old('type') == 'parent' ? 'selected' : '' }}>Parent</option>
            </select>
        </p>
        <div id="employee-section" style="display: none;">
            <label for="employeeid">Pilih Employee</label><br>
            <select name="employeeid" id="employeeid">
                <option value="">-- Pilih Employee --</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->employeeid }}"
                        {{ old('employeeid') == $employee->employeeid ? 'selected' : '' }}>
                        {{ $employee->fullname }}
                    </option>
                @endforeach
            </select>
        </div>
        <div id="parent-section" style="display: none;">
            <label for="parentid">Pilih Parent</label><br>
            <select name="parentid" id="parentid">
                <option value="">-- Pilih Parent --</option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->parentid }}"
                        {{ old('parentid') == $parent->parentid ? 'selected' : '' }}>
                        {{ $parent->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <p>
            <label for="roles">Role</label><br>
            <select name="roles[]" id="roles" multiple required>
                @foreach ($roles as $role)
                    <option value="{{ $role->roleid }}"
                        {{ collect(old('roles'))->contains($role->roleid) ? 'selected' : '' }}>
                        {{ $role->rolename }}
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <button type="submit">Simpan</button>
        </p>
    </form>

    <script>
        function toggleUserType() {
            var type = document.getElementById('type').value;
            document.getElementById('employee-section').style.display = (type === 'employee') ? 'block' : 'none';
            document.getElementById('parent-section').style.display = (type === 'parent') ? 'block' : 'none';
        }
        window.onload = toggleUserType;
    </script>
</body>

</html>
