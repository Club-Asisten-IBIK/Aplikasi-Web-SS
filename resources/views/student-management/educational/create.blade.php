<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Riwayat Pendidikan</title>
</head>

<body>
    <h1>Tambah Riwayat Pendidikan</h1>

    <a href="{{ route('educational.index') }}">Kembali ke Daftar</a>
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

    <form action="{{ route('educational.store') }}" method="POST">
        @csrf

        <p>
            <label for="studentid">Siswa</label><br>
            <select name="studentid" id="studentid" required>
                <option value="">-- Pilih Siswa --</option>
                @foreach ($students as $student)
                    <option value="{{ $student->studentid }}"
                        {{ old('studentid') == $student->studentid ? 'selected' : '' }}>
                        {{ $student->student_number }} - {{ $student->fullname }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label for="institution_name">Nama Institusi</label><br>
            <input type="text" id="institution_name" name="institution_name" value="{{ old('institution_name') }}"
                maxlength="100" required>
        </p>

        <p>
            <label for="institution_address">Alamat Institusi</label><br>
            <textarea id="institution_address" name="institution_address" required>{{ old('institution_address') }}</textarea>
        </p>

        <p>
            <label for="from_age_group">Kelompok Usia Asal</label><br>
            <input type="text" id="from_age_group" name="from_age_group" value="{{ old('from_age_group') }}"
                maxlength="50" required>
        </p>

        <p>
            <label for="admitted_date">Tanggal Masuk</label><br>
            <input type="date" id="admitted_date" name="admitted_date" value="{{ old('admitted_date') }}" required>
        </p>

        <p>
            <label for="admitted_age_group">Kelompok Usia Saat Masuk</label><br>
            <input type="text" id="admitted_age_group" name="admitted_age_group"
                value="{{ old('admitted_age_group') }}" maxlength="50" required>
        </p>

        <p>
            <button type="submit">Simpan</button>
        </p>
    </form>
</body>

</html>
