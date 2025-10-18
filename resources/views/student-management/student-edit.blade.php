<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa - {{ $student->fullname }}</title>
</head>

<body>

    <h1>Edit Data Siswa: {{ $student->fullname }}</h1>

    <a href="{{ route('student.index') }}">Kembali ke Daftar Siswa</a>
    <hr>

    {{-- Menampilkan error validasi --}}
    @if ($errors->any())
        <div style="color: red;">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('student.update', $student->studentid) }}" method="POST">
        @csrf
        @method('PUT') {{-- Method spoofing untuk update --}}

        <fieldset>
            <legend>Informasi Akademik</legend>
            <p>
                <label for="schoolyearid">Tahun Ajaran:</label><br>
                <select name="schoolyearid" id="schoolyearid" required>
                    <option value="">-- Pilih Tahun Ajaran --</option>
                    @foreach ($schoolyears as $year)
                        {{-- Cek old value dulu, baru data asli dari database --}}
                        <option value="{{ $year->schoolyearid }}"
                            {{ old('schoolyearid', $student->schoolyearid) == $year->schoolyearid ? 'selected' : '' }}>
                            {{ $year->schoolyear }}
                        </option>
                    @endforeach
                </select>
            </p>
            <p>
                <label for="classid">Kelas:</label><br>
                <select name="classid" id="classid" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->classid }}"
                            {{ old('classid', $student->classid) == $class->classid ? 'selected' : '' }}>
                            {{ $class->classname }} (Wali: {{ $class->guardian?->name ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>
            </p>
            <p>
                <label for="datejoin">Tanggal Masuk:</label><br>
                <input type="date" id="datejoin" name="datejoin" value="{{ old('datejoin', $student->datejoin) }}"
                    required>
            </p>
            <p>
                <label for="studentfeeamount">Biaya SPP:</label><br>
                <input type="number" id="studentfeeamount" name="studentfeeamount"
                    value="{{ old('studentfeeamount', $student->studentfeeamount) }}" required>
            </p>
        </fieldset>

        <fieldset>
            <legend>Data Diri Siswa</legend>
            <p>
                <label for="student_number">Nomor Induk Siswa (NIS):</label><br>
                <input type="text" id="student_number" name="student_number"
                    value="{{ old('student_number', $student->student_number) }}" required>
            </p>
            <p>
                <label for="fullname">Nama Lengkap:</label><br>
                <input type="text" id="fullname" name="fullname" value="{{ old('fullname', $student->fullname) }}"
                    required>
            </p>
            <p>
                <label for="nickname">Nama Panggilan:</label><br>
                <input type="text" id="nickname" name="nickname" value="{{ old('nickname', $student->nickname) }}">
            </p>
            <p>
                <label for="birthplace">Tempat Lahir:</label><br>
                <input type="text" id="birthplace" name="birthplace"
                    value="{{ old('birthplace', $student->birthplace) }}">
            </p>
            <p>
                <label for="birthdate">Tanggal Lahir:</label><br>
                <input type="date" id="birthdate" name="birthdate"
                    value="{{ old('birthdate', $student->birthdate) }}">
            </p>
            <p>
                <label for="gender">Jenis Kelamin:</label><br>
                <select name="gender" id="gender" required>
                    <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>
                        Perempuan</option>
                </select>
            </p>
            <p>
                <label for="address">Alamat:</label><br>
                <textarea id="address" name="address" rows="3">{{ old('address', $student->address) }}</textarea>
            </p>
            <p>
                <label for="status">Status Siswa:</label><br>
                <select name="status" id="status" required>
                    <option value="Active" {{ old('status', $student->status) == 'Active' ? 'selected' : '' }}>Aktif
                    </option>
                    <option value="Inactive" {{ old('status', $student->status) == 'Inactive' ? 'selected' : '' }}>
                        Tidak Aktif</option>
                    <option value="Graduated" {{ old('status', $student->status) == 'Graduated' ? 'selected' : '' }}>
                        Lulus</option>
                </select>
            </p>
        </fieldset>

        <fieldset>
            <legend>Data Orang Tua</legend>
            <p>
                <label for="parent_name">Nama Orang Tua (Ayah/Ibu):</label><br>
                <input type="text" id="parent_name" name="parent_name"
                    value="{{ old('parent_name', $student->parent?->name) }}">
            </p>
            <p>
                <label for="parent_status">Status Orang Tua:</label><br>
                <input type="text" id="parent_status" name="parent_status"
                    value="{{ old('parent_status', $student->parent?->status) }}" placeholder="Contoh: Ayah Kandung">
            </p>
            <p>
                <label for="parent_contact">Kontak Orang Tua:</label><br>
                <input type="text" id="parent_contact" name="parent_contact"
                    value="{{ old('parent_contact', $student->parent?->contact) }}">
            </p>
            <p>
                <label for="parent_occupation">Pekerjaan Orang Tua:</label><br>
                <input type="text" id="parent_occupation" name="parent_occupation"
                    value="{{ old('parent_occupation', $student->parent?->occupation) }}">
            </p>
        </fieldset>

        <fieldset>
            <legend>Catatan Fisik & Kesehatan</legend>
            <p>
                <label for="height_cm">Tinggi Badan (cm):</label><br>
                <input type="number" id="height_cm" name="height_cm"
                    value="{{ old('height_cm', $student->physicalRecords?->height_cm) }}" required>
            </p>
            <p>
                <label for="weight_kg">Berat Badan (kg):</label><br>
                <input type="number" id="weight_kg" name="weight_kg"
                    value="{{ old('weight_kg', $student->physicalRecords?->weight_kg) }}" required>
            </p>
            <p>
                <label for="blood_type">Golongan Darah:</label><br>
                <select name="blood_type" id="blood_type" required>
                    <option value="A"
                        {{ old('blood_type', $student->physicalRecords?->blood_type) == 'A' ? 'selected' : '' }}>A
                    </option>
                    <option value="B"
                        {{ old('blood_type', $student->physicalRecords?->blood_type) == 'B' ? 'selected' : '' }}>B
                    </option>
                    <option value="AB"
                        {{ old('blood_type', $student->physicalRecords?->blood_type) == 'AB' ? 'selected' : '' }}>AB
                    </option>
                    <option value="O"
                        {{ old('blood_type', $student->physicalRecords?->blood_type) == 'O' ? 'selected' : '' }}>O
                    </option>
                </select>
            </p>
            <p>
                <label for="medical_history">Riwayat Penyakit:</label><br>
                <textarea id="medical_history" name="medical_history" rows="3">{{ old('medical_history', $student->physicalRecords?->medical_history) }}</textarea>
            </p>
        </fieldset>

        <br>
        <button type="submit">Update Data Siswa</button>

    </form>
</body>

</html>
