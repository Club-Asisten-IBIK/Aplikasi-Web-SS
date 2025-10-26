<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User Role</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 2rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        select,
        button {
            width: 300px;
            padding: 0.5rem;
        }

        select:disabled {
            background: #eee;
        }

        .alert-success {
            padding: 1rem;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>

    <h2>Form Tambah User Role</h2>

    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('userrole.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="userid">User:</label>
            <select name="userid" id="userid" required>
                <option value="">-- Pilih User --</option>
                @foreach ($data['users'] as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="parentid">Parent:</label>
            <select name="parentid" id="parentid">
                <option value="">-- (Opsional) Pilih Parent --</option>
                @foreach ($data['parents'] as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="employeeid">Employee:</label>
            <select name="employeeid" id="employeeid">
                <option value="">-- (Opsional) Pilih Employee --</option>
                @foreach ($data['employees'] as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="roleid">Role:</label>
            <select name="roleid" id="roleid">
                <option value="">-- Pilih Role --</option>
                @foreach ($data['roles'] as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Simpan</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen select
            const parentSelect = document.getElementById('parentid');
            const employeeSelect = document.getElementById('employeeid');
            const roleSelect = document.getElementById('roleid');

            function handleLogic() {
                const parentValue = parentSelect.value;
                const employeeValue = employeeSelect.value;

                // Logika 1: "jika pilih parent maka employee disable dan role [disable]"
                if (parentValue) {
                    employeeSelect.disabled = true;
                    roleSelect.disabled = true;

                    // Kosongkan pilihan employee jika parent dipilih
                    employeeSelect.value = '';
                }
                // Logika 2: "jika pilih employee maka [...] role juga ditampilkan [enabled]"
                // (Ini terjadi HANYA JIKA parent TIDAK dipilih)
                else if (employeeValue) {
                    employeeSelect.disabled = false; // Pastikan employee enabled
                    roleSelect.disabled = false; // Enable-kan role
                }
                // Logika 3: Default (Parent KOSONG dan Employee KOSONG)
                else {
                    employeeSelect.disabled = false; // Employee harus bisa dipilih
                    roleSelect.disabled = true; // Role di-disable (karena butuh employee)
                }
            }

            // Tambahkan event listener ke parent dan employee
            parentSelect.addEventListener('change', handleLogic);
            employeeSelect.addEventListener('change', handleLogic);

            // Jalankan logika sekali saat halaman dimuat
            handleLogic();
        });
    </script>

</body>

</html>
