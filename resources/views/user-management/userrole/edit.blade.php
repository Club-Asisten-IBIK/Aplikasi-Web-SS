<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit UserRole</title>
</head>

<body>
    <h1>Edit UserRole</h1>
    <a href="{{ route('userrole.index') }}">Kembali ke Daftar</a>
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
    <form action="{{ route('userrole.update', $userRole->id) }}" method="POST">
        @csrf
        @method('PUT')
        <p>
            <label>UserID: {{ $userRole->userid }}</label>
        </p>
        <p>
            <label>RoleID: {{ $userRole->roleid }}</label>
        </p>
        <p>
            <label for="employeeid">Employee</label><br>
            <select name="employeeid" required>
                <option value="">- Pilih Employee -</option>
                @foreach ($employees as $emp)
                    <option value="{{ $emp->employeeid }}"
                        {{ $userRole->employeeid == $emp->employeeid ? 'selected' : '' }}>
                        {{ $emp->fullname }}
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <label for="parentid">Parent</label><br>
            <select name="parentid" required>
                <option value="">- Pilih Parent -</option>
                @foreach ($parents as $par)
                    <option value="{{ $par->parentid }}" {{ $userRole->parentid == $par->parentid ? 'selected' : '' }}>
                        {{ $par->name }}
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <button type="submit">Update</button>
        </p>
    </form>
</body>

</html>
