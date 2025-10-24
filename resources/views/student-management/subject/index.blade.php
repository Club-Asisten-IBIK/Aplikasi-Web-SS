<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mata Pelajaran</title>
</head>

<body>
    <h1>Daftar Mata Pelajaran</h1>

    @if (session('added'))
        <div class="alert alert-success">Mata pelajaran berhasil ditambahkan</div>
    @endif
    @if (session('edited'))
        <div class="alert alert-success">Mata pelajaran berhasil diperbarui</div>
    @endif
    @if (session('deleted'))
        <div class="alert alert-success">Mata pelajaran berhasil dihapus</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <button onclick="window.location='{{ route('subject.create') }}'">Tambah Mata Pelajaran</button>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Mata Pelajaran</th>
                <th>Grade</th>
                <th>Guru Pengajar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)
                <tr>
                    <td>{{ $subject->code }}</td>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->gradelevel }}</td>
                    <td>
                        @if ($subject->teachers->count() > 0)
                            <ul>
                                @foreach ($subject->teachers as $teacher)
                                    <li>{{ $teacher->employee->fullname }} ({{ $teacher->employee->nip }})</li>
                                @endforeach
                            </ul>
                        @else
                            <span>Belum ada guru pengajar</span>
                        @endif
                    </td>
                    <td>{{ $subject->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>
                    <td>
                        <button onclick="window.location='{{ route('subject.edit', $subject->subjectid) }}'">
                            Edit
                        </button>
                        <form action="{{ route('subject.destroy', $subject->subjectid) }}" method="POST"
                            style="display:inline"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata pelajaran ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
