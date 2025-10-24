<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mata Pelajaran</title>
</head>

<body>
    <h1>Form Tambah Mata Pelajaran</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subject.store') }}" method="POST">
        @csrf
        <table>
            <tr>
                <td>Kode Mata Pelajaran:</td>
                <td><input type="text" name="code" value="{{ old('code') }}" required></td>
            </tr>
            <tr>
                <td>Nama Mata Pelajaran:</td>
                <td><input type="text" name="name" value="{{ old('name') }}" required></td>
            </tr>
            <tr>
                <td>Grade Level:</td>
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
                <td>Status:</td>
                <td>
                    <select name="is_active" required>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Guru Pengajar:</td>
                <td>
                    <select name="employee_ids[]" multiple required>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->employeeid }}">
                                {{ $employee->fullname }} ({{ $employee->nip }})
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
        </table>
        <button type="submit">Simpan</button>
        <a href="{{ route('subject.index') }}">Kembali</a>
    </form>
</body>

</html>
