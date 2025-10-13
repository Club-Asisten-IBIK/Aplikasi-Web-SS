<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa: {{ $student->fullname }}</title>
</head>

<body>

    <h1>Form Edit Data Siswa (Buku Induk)</h1>
    <a href="{{ route('student.index') }}">Kembali ke Daftar Siswa</a>
    <hr>

    <form action="{{ route('student.update', $student->studentid) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Menampilkan error validasi global --}}
        @if ($errors->any())
            <div style="color: red;">
                <strong>Terjadi kesalahan validasi:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <fieldset>
            <legend><strong>A. KETERANGAN PESERTA DIDIK</strong></legend>
            <table cellpadding="5">
                <tr>
                    <td><label for="student_number">Nomor Induk</label></td>
                    <td><input type="text" id="student_number" name="student_number"
                            value="{{ old('student_number', $student->student_number) }}" required></td>
                </tr>
                <tr>
                    <td><label for="schoolyearid">Tahun Ajaran</label></td>
                    <td>
                        <select id="schoolyearid" name="schoolyearid" required>
                            <option value="">-- Pilih Tahun Ajaran --</option>
                            @foreach ($schoolyears as $year)
                                <option value="{{ $year->schoolyearid }}"
                                    {{ old('schoolyearid', $student->schoolyearid) == $year->schoolyearid ? 'selected' : '' }}>
                                    {{ $year->year }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="classid">Kelas</label></td>
                    <td>
                        <select id="classid" name="classid" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->classid }}"
                                    {{ old('classid', $student->classid) == $class->classid ? 'selected' : '' }}>
                                    {{ $class->classname }} (Wali: {{ $class->guardian->name ?? 'N/A' }})
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="fullname">Nama Lengkap</label></td>
                    <td><input type="text" id="fullname" name="fullname"
                            value="{{ old('fullname', $student->fullname) }}" required></td>
                </tr>
                <tr>
                    <td><label for="nickname">Nama Panggilan</label></td>
                    <td><input type="text" id="nickname" name="nickname"
                            value="{{ old('nickname', $student->nickname) }}"></td>
                </tr>
                <tr>
                    <td><label for="gender">Jenis Kelamin</label></td>
                    <td>
                        <select id="gender" name="gender" required>
                            <option value="Laki-laki"
                                {{ old('gender', $student->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="Perempuan"
                                {{ old('gender', $student->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="birthplace">Tempat Lahir</label></td>
                    <td><input type="text" id="birthplace" name="birthplace"
                            value="{{ old('birthplace', $student->birthplace) }}"></td>
                </tr>
                <tr>
                    <td><label for="birthdate">Tanggal Lahir</label></td>
                    <td><input type="date" id="birthdate" name="birthdate"
                            value="{{ old('birthdate', $student->birthdate) }}"></td>
                </tr>
                <tr>
                    <td><label for="address">Alamat</label></td>
                    <td>
                        <textarea id="address" name="address" rows="3">{{ old('address', $student->address) }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td><label for="datejoin">Tanggal Diterima</label></td>
                    <td><input type="date" id="datejoin" name="datejoin"
                            value="{{ old('datejoin', $student->datejoin) }}" required></td>
                </tr>
                <tr>
                    <td><label for="status">Status Siswa</label></td>
                    <td>
                        <select name="status" id="status" required>
                            <option value="student"
                                {{ old('status', $student->status) == 'student' ? 'selected' : '' }}>Siswa Aktif
                            </option>
                            <option value="prostudent"
                                {{ old('status', $student->status) == 'prostudent' ? 'selected' : '' }}>Calon Siswa
                            </option>
                            <option value="graduated"
                                {{ old('status', $student->status) == 'graduated' ? 'selected' : '' }}>Lulus</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="studentfeeamount">Biaya Pendidikan</label></td>
                    <td><input type="number" id="studentfeeamount" name="studentfeeamount"
                            value="{{ old('studentfeeamount', $student->studentfeeamount) }}" required></td>
                </tr>
            </table>
        </fieldset>

        <br>

        <fieldset>
            <legend><strong>B. KETERANGAN ORANG TUA / WALI</strong></legend>
            <table cellpadding="5">
                <tr>
                    <td><label for="parent_name">Nama Ayah/Ibu</label></td>
                    <td><input type="text" id="parent_name" name="parent_name"
                            value="{{ old('parent_name', $student->parent->name ?? '') }}"></td>
                </tr>
                <tr>
                    <td><label for="parent_status">Status (Hubungan)</label></td>
                    <td>
                        <select name="parent_status" id="parent_status">
                            <option value="">-- Pilih --</option>
                            <option value="father"
                                {{ old('parent_status', $student->parent->status ?? '') == 'father' ? 'selected' : '' }}>
                                Ayah</option>
                            <option value="mother"
                                {{ old('parent_status', $student->parent->status ?? '') == 'mother' ? 'selected' : '' }}>
                                Ibu</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="parent_contact">Kontak Ortu</label></td>
                    <td><input type="text" id="parent_contact" name="parent_contact"
                            value="{{ old('parent_contact', $student->parent->contact ?? '') }}"></td>
                </tr>
                <tr>
                    <td><label for="parent_occupation">Pekerjaan Ortu</label></td>
                    <td><input type="text" id="parent_occupation" name="parent_occupation"
                            value="{{ old('parent_occupation', $student->parent->occupation ?? '') }}"></td>
                </tr>
                <tr>
                    <td><label for="parent_education">Pendidikan Ortu</label></td>
                    <td><input type="text" id="parent_education" name="parent_education"
                            value="{{ old('parent_education', $student->parent->education ?? '') }}"></td>
                </tr>
            </table>
        </fieldset>

        <br>

        <fieldset>
            <legend><strong>C. KEADAAN JASMANI</strong></legend>
            <table cellpadding="5">
                <tr>
                    <td><label for="height_cm">Tinggi Badan (cm)</label></td>
                    <td><input type="number" step="0.1" id="height_cm" name="height_cm"
                            value="{{ old('height_cm', $student->physicalRecords->first()->height_cm ?? '') }}"></td>
                </tr>
                <tr>
                    <td><label for="weight_kg">Berat Badan (kg)</label></td>
                    <td><input type="number" step="0.1" id="weight_kg" name="weight_kg"
                            value="{{ old('weight_kg', $student->physicalRecords->first()->weight_kg ?? '') }}"></td>
                </tr>
                <tr>
                    <td><label for="blood_type">Golongan Darah</label></td>
                    <td>
                        <select name="blood_type" id="blood_type">
                            <option value="A"
                                {{ old('blood_type', $student->physicalRecords->first()->blood_type ?? '') == 'A' ? 'selected' : '' }}>
                                A</option>
                            <option value="B"
                                {{ old('blood_type', $student->physicalRecords->first()->blood_type ?? '') == 'B' ? 'selected' : '' }}>
                                B</option>
                            <option value="AB"
                                {{ old('blood_type', $student->physicalRecords->first()->blood_type ?? '') == 'AB' ? 'selected' : '' }}>
                                AB</option>
                            <option value="O"
                                {{ old('blood_type', $student->physicalRecords->first()->blood_type ?? '') == 'O' ? 'selected' : '' }}>
                                O</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="medical_history">Riwayat Penyakit</label></td>
                    <td>
                        <textarea id="medical_history" name="medical_history" rows="3">{{ old('medical_history', $student->physicalRecords->first()->medical_history ?? '') }}</textarea>
                    </td>
                </tr>
            </table>
        </fieldset>

        <br>

        <button type="submit">Update Data Siswa</button>
    </form>

</body>

</html>
