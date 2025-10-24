<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Catatan Kelulusan/Keluar</title>
</head>

<body>
    <h1>Daftar Catatan Kelulusan/Keluar Siswa</h1>

    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <p>
        <a href="{{ route('leaving-records.create') }}">Tambah Catatan Kelulusan/Keluar</a>
    </p>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nomor Siswa</th>
                <th>Nama Siswa</th>
                <th>Tipe Surat</th>
                <th>Institusi Tujuan</th>
                <th>Tanggal Keluar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($leavingRecords as $record)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $record->student->student_number }}</td>
                    <td>{{ $record->student->fullname }}</td>
                    <td>{{ $record->letter_type }}</td>
                    <td>{{ $record->destination_institution }}</td>
                    <td>{{ $record->exit_date }}</td>
                    <td>
                        <a href="{{ route('leaving-records.show', $record->leaving_recordid) }}">Detail</a>
                        <a href="{{ route('leaving-records.edit', $record->leaving_recordid) }}">Edit</a>
                        <form action="{{ route('leaving-records.destroy', $record->leaving_recordid) }}" method="POST"
                            style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus data?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Tidak ada catatan kelulusan/keluar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
