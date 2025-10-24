<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Catatan Kelulusan/Keluar</title>
</head>

<body>
    <h1>Detail Catatan Kelulusan/Keluar</h1>

    <a href="{{ route('leaving-records.index') }}">Kembali ke Daftar</a>
    <hr>

    <h2>Data Siswa</h2>
    <table>
        <tr>
            <td>Nomor Siswa</td>
            <td>: {{ $leavingRecord->student->student_number }}</td>
        </tr>
        <tr>
            <td>Nama Lengkap</td>
            <td>: {{ $leavingRecord->student->fullname }}</td>
        </tr>
    </table>

    <h2>Informasi Kelulusan/Keluar</h2>
    <table>
        <tr>
            <td>Tipe Entri</td>
            <td>: {{ $leavingRecord->entry_type }}</td>
        </tr>
        <tr>
            <td>Tipe Surat</td>
            <td>: {{ $leavingRecord->letter_type }}</td>
        </tr>
        <tr>
            <td>Melanjutkan ke Institusi</td>
            <td>: {{ $leavingRecord->continues_to_institution }}</td>
        </tr>
        <tr>
            <td>Kelompok Usia Asal</td>
            <td>: {{ $leavingRecord->from_age_group }}</td>
        </tr>
        <tr>
            <td>Institusi Tujuan</td>
            <td>: {{ $leavingRecord->destination_institution }}</td>
        </tr>
        <tr>
            <td>Level Kelompok Usia Tujuan</td>
            <td>: {{ $leavingRecord->destination_age_group_level }}</td>
        </tr>
        <tr>
            <td>Tanggal Transfer</td>
            <td>: {{ $leavingRecord->transfer_date }}</td>
        </tr>
        <tr>
            <td>Tanggal Keluar</td>
            <td>: {{ $leavingRecord->exit_date }}</td>
        </tr>
        <tr>
            <td>Alasan</td>
            <td>: {{ $leavingRecord->reason ?? '-' }}</td>
        </tr>
    </table>

    <hr>
    <a href="{{ route('leaving-records.edit', $leavingRecord->leaving_recordid) }}">Edit</a>
    <form action="{{ route('leaving-records.destroy', $leavingRecord->leaving_recordid) }}" method="POST"
        style="display:inline">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Yakin ingin menghapus data?')">
            Hapus
        </button>
    </form>
</body>

</html>
