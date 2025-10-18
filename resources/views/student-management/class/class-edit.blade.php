<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas Baru</title>
</head>

<body>
    <h1>Form Tambah Kelas</h1>

    <a href="{{ route('class.index') }}">Kembali ke Daftar Kelas</a>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('class.store') }}" method="POST">
        @csrf
        <table>
            <tr>
                <td>Nama Kelas:</td>
                <td><input type="text" name="classname" value="{{ old('classname') }}" required></td>
            </tr>
            <tr>
                <td>Tingkat:</td>
                <td>
                    <select name="gradelevel" required>
                        <option value="TK-A">TK-A</option>
                        <option value="TK-B">TK-B</option>
                        @for ($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </td>
            </tr>
            <tr>
                <td>Wali Kelas:</td>
                <td>
                    <select name="guardianid" required>
                        <option value="">Pilih Wali Kelas</option>
                        @foreach ($guardians as $guardian)
                            <option value="{{ $guardian->guardianid }}"
                                {{ isset($class) && $class->guardianid == $guardian->guardianid ? 'selected' : '' }}>
                                {{ $guardian->employee->fullname }} ({{ $guardian->employee->nip }})
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Kapasitas:</td>
                <td><input type="number" name="capacity" value="{{ old('capacity') }}" required></td>
            </tr>
            <tr>
                <td>Status:</td>
                <td>
                    <select name="isactive">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </td>
            </tr>
        </table>
        <button type="submit">Simpan</button>
    </form>
</body>

</html>
