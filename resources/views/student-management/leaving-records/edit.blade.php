<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Catatan Kelulusan/Keluar</title>
</head>

<body>
    <h1>Edit Catatan Kelulusan/Keluar</h1>

    <a href="{{ route('leaving-records.index') }}">Kembali ke Daftar</a>
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

    <form action="{{ route('leaving-records.update', $leavingRecord->leaving_recordid) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label for="studentid">Siswa</label><br>
            <select name="studentid" id="studentid" required>
                <option value="">-- Pilih Siswa --</option>
                @foreach ($students as $student)
                    <option value="{{ $student->studentid }}"
                        {{ old('studentid', $leavingRecord->studentid) == $student->studentid ? 'selected' : '' }}>
                        {{ $student->student_number }} - {{ $student->fullname }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label for="entry_type">Tipe Entri</label><br>
            <input type="text" name="entry_type" id="entry_type" maxlength="10"
                value="{{ old('entry_type', $leavingRecord->entry_type) }}" required>
        </p>

        <p>
            <label for="letter_type">Tipe Surat</label><br>
            <input type="text" name="letter_type" id="letter_type" maxlength="100"
                value="{{ old('letter_type', $leavingRecord->letter_type) }}" required>
        </p>

        <p>
            <label for="continues_to_institution">Melanjutkan ke Institusi</label><br>
            <input type="text" name="continues_to_institution" id="continues_to_institution" maxlength="150"
                value="{{ old('continues_to_institution', $leavingRecord->continues_to_institution) }}" required>
        </p>

        <p>
            <label for="from_age_group">Kelompok Usia Asal</label><br>
            <input type="text" name="from_age_group" id="from_age_group" maxlength="50"
                value="{{ old('from_age_group', $leavingRecord->from_age_group) }}" required>
        </p>

        <p>
            <label for="destination_institution">Institusi Tujuan</label><br>
            <input type="text" name="destination_institution" id="destination_institution" maxlength="50"
                value="{{ old('destination_institution', $leavingRecord->destination_institution) }}" required>
        </p>

        <p>
            <label for="destination_age_group_level">Level Kelompok Usia Tujuan</label><br>
            <input type="text" name="destination_age_group_level" id="destination_age_group_level" maxlength="50"
                value="{{ old('destination_age_group_level', $leavingRecord->destination_age_group_level) }}" required>
        </p>

        <p>
            <label for="transfer_date">Tanggal Transfer</label><br>
            <input type="date" name="transfer_date" id="transfer_date"
                value="{{ old('transfer_date', $leavingRecord->transfer_date) }}" required>
        </p>

        <p>
            <label for="exit_date">Tanggal Keluar</label><br>
            <input type="date" name="exit_date" id="exit_date"
                value="{{ old('exit_date', $leavingRecord->exit_date) }}" required>
        </p>

        <p>
            <label for="reason">Alasan</label><br>
            <textarea name="reason" id="reason">{{ old('reason', $leavingRecord->reason) }}</textarea>
        </p>

        <p>
            <button type="submit">Simpan Perubahan</button>
        </p>
    </form>
</body>

</html>
