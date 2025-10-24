<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Riwayat Pendidikan</title>
</head>

<body>
    <h1>Daftar Riwayat Pendidikan Siswa</h1>

    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <p>
        <a href="{{ route('educational.create') }}">Tambah Riwayat Pendidikan</a>
    </p>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Siswa</th>
                <th>Nama Siswa</th>
                <th>Nama Institusi</th>
                <th>Kelompok Usia Asal</th>
                <th>Tanggal Masuk</th>
                <th>Kelompok Usia Saat Masuk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($histories as $history)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $history->student->student_number }}</td>
                    <td>{{ $history->student->fullname }}</td>
                    <td>{{ $history->institution_name }}</td>
                    <td>{{ $history->from_age_group }}</td>
                    <td>{{ $history->admitted_date }}</td>
                    <td>{{ $history->admitted_age_group }}</td>
                    <td>
                        <a href="{{ route('educational.show', $history->educational_historyid) }}">Detail</a>
                        <a href="{{ route('educational.edit', $history->educational_historyid) }}">Edit</a>
                        <form action="{{ route('educational.destroy', $history->educational_historyid) }}"
                            method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Tidak ada data riwayat pendidikan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
