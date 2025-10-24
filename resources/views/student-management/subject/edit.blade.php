<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mata Pelajaran</title>
</head>

<body>
    <h1>Edit Mata Pelajaran</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subject.update', $subject->subjectid) }}" method="POST">
        @csrf
        @method('PUT')

        <table>
            <tr>
                <td>Kode Mata Pelajaran:</td>
                <td><input type="text" name="code" value="{{ old('code', $subject->code) }}" required></td>
            </tr>
            <tr>
                <td>Nama Mata Pelajaran:</td>
                <td><input type="text" name="name" value="{{ old('name', $subject->name) }}" required></td>
            </tr>
            <tr>
                <td>Grade Level:</td>
                <td>
                    <select name="gradelevel" required>
                        <option value="TK-A" {{ $subject->gradelevel == 'TK-A' ? 'selected' : '' }}>TK-A</option>
                        <option value="TK-B" {{ $subject->gradelevel == 'TK-B' ? 'selected' : '' }}>TK-B</option>
                        @for ($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ $subject->gradelevel == $i ? 'selected' : '' }}>
                                {{ $i }}</option>
                        @endfor
                    </select>
                </td>
            </tr>
            <tr>
                <td>Status:</td>
                <td>
                    <select name="is_active" required>
                        <option value="1" {{ $subject->is_active ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ !$subject->is_active ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Guru Pengajar:</td>
                <td>
                    <select name="employee_ids[]" multiple required>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->employeeid }}"
                                {{ in_array($employee->employeeid, $subject->teachers->pluck('employee_id')->toArray()) ? 'selected' : '' }}>
                                {{ $employee->fullname }} ({{ $employee->nip }})
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
        </table>

        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('subject.index') }}">Kembali</a>
    </form>
</body>

</html>
