<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa Baru</title>
</head>

<body>

    <h1>Formulir Tambah Siswa Baru</h1>

    <a href="{{ route('student.index') }}">Kembali ke Daftar Siswa</a>
    <hr>

    @if ($errors->any())
        <div style="color: red;">
            <strong>Terjadi Kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <hr>
    @endif

    @if (session('error'))
        <div style="color: red;">{{ session('error') }}</div>
        <hr>
    @endif

    <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <h3>Informasi Akademik</h3>
        <p>
            <label for="schoolyearid">Tahun Ajaran</label><br>
            <select name="schoolyearid" id="schoolyearid" required>
                <option value="">-- Pilih Tahun Ajaran --</option>
                @foreach ($schoolyears as $year)
                    <option value="{{ $year->schoolyearid }}"
                        {{ old('schoolyearid') == $year->schoolyearid ? 'selected' : '' }}>
                        {{ $year->schoolyear }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label for="classid">Kelas</label><br>
            <select name="classid" id="classid" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->classid }}" {{ old('classid') == $class->classid ? 'selected' : '' }}>
                        {{ $class->classname }} (Wali:
                        {{ $class->teacher?->employee?->fullname ?? 'Belum ditentukan' }})
                    </option>
                @endforeach
            </select>
        </p>

        <h3>Data Siswa</h3>
        <p>
            <label for="student_number">Nomor Siswa</label><br>
            <input type="text" id="student_number" name="student_number" value="{{ old('student_number') }}"
                maxlength="20" required>
        </p>

        <p>
            <label for="fullname">Nama Lengkap</label><br>
            <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}" maxlength="50" required>
        </p>

        <p>
            <label for="nickname">Nama Panggilan</label><br>
            <input type="text" id="nickname" name="nickname" value="{{ old('nickname') }}" maxlength="50">
        </p>

        <p>
            <label for="birthplace">Tempat Lahir</label><br>
            <input type="text" id="birthplace" name="birthplace" value="{{ old('birthplace') }}" maxlength="50"
                required>
        </p>

        <p>
            <label for="birthdate">Tanggal Lahir</label><br>
            <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required>
        </p>

        <p>
            <label for="gender">Jenis Kelamin</label><br>
            <select name="gender" id="gender" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </p>

        <p>
            <label for="religion">Agama</label><br>
            <select name="religion" id="religion" required>
                <option value="">-- Pilih --</option>
                @foreach (['Islam', 'Kristen', 'Hindu', 'Buddha', 'Konghucu'] as $r)
                    <option value="{{ $r }}" {{ old('religion') == $r ? 'selected' : '' }}>
                        {{ $r }}</option>
                @endforeach
            </select>
        </p>

        <p>
            <label for="nationality">Kewarganegaraan</label><br>
            <select name="nationality" id="nationality" required>
                <option value="">-- Pilih --</option>
                <option value="WNI" {{ old('nationality') == 'WNI' ? 'selected' : '' }}>WNI</option>
                <option value="WNA" {{ old('nationality') == 'WNA' ? 'selected' : '' }}>WNA</option>
            </select>
        </p>

        <p>
            <label for="siblings_full">Jumlah Saudara Kandung</label><br>
            <input type="number" id="siblings_full" name="siblings_full" min="0"
                value="{{ old('siblings_full') }}">
        </p>

        <p>
            <label for="siblings_step">Jumlah Saudara Tiri</label><br>
            <input type="number" id="siblings_step" name="siblings_step" min="0"
                value="{{ old('siblings_step') }}">
        </p>

        <p>
            <label for="siblings_adopted">Jumlah Saudara Angkat</label><br>
            <input type="number" id="siblings_adopted" name="siblings_adopted" min="0"
                value="{{ old('siblings_adopted') }}">
        </p>

        <p>
            <label for="home_language">Bahasa di Rumah</label><br>
            <input type="text" id="home_language" name="home_language" maxlength="100"
                value="{{ old('home_language') }}">
        </p>

        <p>
            <label for="address">Alamat</label><br>
            <textarea id="address" name="address" required>{{ old('address') }}</textarea>
        </p>

        <p>
            <label for="living_with">Tinggal Dengan</label><br>
            <select name="living_with" id="living_with">
                <option value="">-- Pilih --</option>
                <option value="Orang Tua" {{ old('living_with') == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                <option value="Wali" {{ old('living_with') == 'Wali' ? 'selected' : '' }}>Wali</option>
                <option value="Keluarga Lain" {{ old('living_with') == 'Keluarga Lain' ? 'selected' : '' }}>Keluarga
                    Lain</option>
            </select>
        </p>

        <p>
            <label for="distance_km">Jarak ke Sekolah (km)</label><br>
            <input type="number" id="distance_km" name="distance_km" step="0.01"
                value="{{ old('distance_km') }}">
        </p>

        <p>
            <label for="photo">Foto</label><br>
            <input type="file" id="photo" name="photo" accept="image/*">
        </p>

        <p>
            <label for="status">Status</label><br>
            <select name="status" id="status" required>
                <option value="">-- Pilih --</option>
                <option value="prostudent" {{ old('status') == 'prostudent' ? 'selected' : '' }}>Pro Student</option>
                <option value="student" {{ old('status') == 'student' ? 'selected' : '' }}>Student</option>
                <option value="graduated" {{ old('status') == 'graduated' ? 'selected' : '' }}>Graduated</option>
            </select>
        </p>

        <p>
            <label for="datejoin">Tanggal Bergabung</label><br>
            <input type="date" id="datejoin" name="datejoin" value="{{ old('datejoin') }}" required>
        </p>

        <p>
            <label for="studentfeeamount">Jumlah Biaya Siswa</label><br>
            <input type="number" id="studentfeeamount" name="studentfeeamount" step="0.01"
                value="{{ old('studentfeeamount') }}" required>
        </p>

        <p>
            <label for="contract">Kontrak</label><br>
            <input type="text" id="contract" name="contract" maxlength="100" value="{{ old('contract') }}"
                required>
        </p>

        <hr>
        <h3>Data Orang Tua / Wali</h3>

        <div>
            <h4>Orang Tua </h4>
            <p>
                <label for="parents_0_name">Nama</label><br>
                <input type="text" id="parents_0_name" name="parents[0][name]"
                    value="{{ old('parents.0.name') }}" maxlength="50">
            </p>

            <p>
                <label for="parents_0_status">Hubungan</label><br>
                <select name="parents[0][status]" id="parents_0_status">
                    <option value="">-- Pilih --</option>
                    <option value="father" {{ old('parents.0.status') == 'father' ? 'selected' : '' }}>Ayah</option>
                    <option value="mother" {{ old('parents.0.status') == 'mother' ? 'selected' : '' }}>Ibu</option>
                    <option value="other" {{ old('parents.0.status') == 'other' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </p>

            <p>
                <label for="parents_0_contact">Kontak</label><br>
                <input type="text" id="parents_0_contact" name="parents[0][contact]"
                    value="{{ old('parents.0.contact') }}" maxlength="16">
            </p>
            <p>
                <label for="parents_0_occupation">Pekerjaan</label><br>
                <input type="text" id="parents_0_occupation" name="parents[0][occupation]"
                    value="{{ old('parents.0.occupation') }}" maxlength="50">
            </p>

            <p>
                <label for="parents_0_education">Pendidikan</label><br>
                <select name="parents[0][education]" id="parents_0_education">
                    <option value="">-- Pilih --</option>
                    @foreach (['SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3', 'none'] as $ed)
                        <option value="{{ $ed }}"
                            {{ old('parents.0.education') == $ed ? 'selected' : '' }}>
                            {{ $ed }}
                        </option>
                    @endforeach
                </select>
            </p>
        </div>

        {{-- <div>
            <h4>Orang Tua 2</h4>
            <p>
                <label for="parents_1_name">Nama</label><br>
                <input type="text" id="parents_1_name" name="parents[1][name]"
                    value="{{ old('parents.1.name') }}" maxlength="50">
            </p>

            <p>
                <label for="parents_1_status">Hubungan</label><br>
                <select name="parents[1][status]" id="parents_1_status">
                    <option value="">-- Pilih --</option>
                    <option value="father" {{ old('parents.1.status') == 'father' ? 'selected' : '' }}>Ayah</option>
                    <option value="mother" {{ old('parents.1.status') == 'mother' ? 'selected' : '' }}>Ibu</option>
                    <option value="other" {{ old('parents.1.status') == 'other' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </p>

            <p>
                <label for="parents_1_contact">Kontak</label><br>
                <input type="text" id="parents_1_contact" name="parents[1][contact]"
                    value="{{ old('parents.1.contact') }}" maxlength="16">
            </p>

            < <p>
                <label for="parents_1_education">Pendidikan</label><br>
                <select name="parents[1][education]" id="parents_1_education">
                    <option value="">-- Pilih --</option>
                    @foreach (['SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3', 'none'] as $ed)
                        <option value="{{ $ed }}"
                            {{ old('parents.1.education') == $ed ? 'selected' : '' }}>
                            {{ $ed }}
                        </option>
                    @endforeach
                </select>
                </p>
        </div> --}}
        <hr>
        <h3>Catatan Fisik & Kesehatan</h3>
        <p>
            <label for="height_cm">Tinggi Badan (cm)</label><br>
            <input type="number" id="height_cm" name="height_cm" step="0.01" value="{{ old('height_cm') }}">
        </p>

        <p>
            <label for="weight_kg">Berat Badan (kg)</label><br>
            <input type="number" id="weight_kg" name="weight_kg" step="0.01" value="{{ old('weight_kg') }}">
        </p>

        <p>
            <label for="blood_type">Golongan Darah</label><br>
            <select name="blood_type" id="blood_type">
                <option value="">-- Pilih --</option>
                @foreach (['A', 'B', 'AB', 'O'] as $b)
                    <option value="{{ $b }}" {{ old('blood_type') == $b ? 'selected' : '' }}>
                        {{ $b }}</option>
                @endforeach
            </select>
        </p>

        <p>
            <label for="medical_history">Riwayat Penyakit</label><br>
            <textarea id="medical_history" name="medical_history">{{ old('medical_history') }}</textarea>
        </p>

        <p>
            <button type="submit">Simpan Data Siswa</button>
        </p>
    </form>

</body>

</html>
