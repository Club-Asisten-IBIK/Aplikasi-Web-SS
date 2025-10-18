<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Siswa</title>
</head>

<body>

    <h1>Daftar Siswa</h1>

    {{-- Menampilkan notifikasi setelah aksi --}}
    @if (session('added'))
        <p style="color: green;">Data siswa berhasil ditambahkan.</p>
    @endif
    @if (session('edited'))
        <p style="color: blue;">Data siswa berhasil diperbarui.</p>
    @endif
    @if (session('deleted'))
        <p style="color: red;">Data siswa berhasil dihapus.</p>
    @endif

    <a href="{{ route('student.create') }}">Tambah Siswa Baru</a>
    <hr>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>NIS</th>
                <th>Nama Lengkap</th>
                <th>Kelas</th>
                <th>Wali Kelas</th>
                <th>Orang Tua</th>
                <th>Tahun Ajaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->student_number }}</td>
                    <td>{{ $student->fullname }}</td>
                    {{-- Menggunakan null safe operator (?->) untuk mencegah error jika relasi kosong --}}
                    <td>{{ $student->class?->classname }}</td>
                    <td>{{ $student->class?->guardian?->name }}</td>
                    <td>{{ $student->parent?->name ?? 'N/A' }}</td>
                    <td>{{ $student->schoolyear?->schoolyear }}</td>
                    <td>
                        <a href="{{ route('student.edit', $student->studentid) }}">Edit</a>
                        |
                        <form action="{{ route('student.destroy', $student->studentid) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Anda yakin ingin menghapus data siswa ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" align="center">Tidak ada data siswa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
