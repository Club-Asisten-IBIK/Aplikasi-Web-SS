<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
</head>

<body>
    <h1>Employee Management</h1>

    @if (session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif
    @if (session('edited'))
        <p style="color:blue;">Employee updated successfully</p>
    @endif
    @if (session('deleted'))
        <p style="color:red;">Employee deleted successfully</p>
    @endif

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <button onclick="document.getElementById('addEmployeeForm').style.display='block'">Add New Employee</button>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>NIP</th>
                <th>Name</th>
                <th>Education</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
                <tr>
                    <td>{{ $employee->nip }}</td>
                    <td>{{ $employee->fronttitle }} {{ $employee->fullname }} {{ $employee->backtitle }}</td>
                    <td>{{ $employee->education }}</td>
                    <td>{{ $employee->contact }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->marital_status }}</td>
                    <td>
                        <button onclick="editEmployee({{ $employee->employeeid }})">Edit</button>
                        <button
                            onclick="if(confirm('Delete this employee?')) deleteEmployee({{ $employee->employeeid }})">Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No employees found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Add Employee Form -->
    <div id="addEmployeeForm" style="display:none;">
        <h2>Add New Employee</h2>
        <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label>NIP: <input type="text" name="nip" required value="{{ old('nip') }}"></label><br>
            <label>Full Name: <input type="text" name="fullname" required value="{{ old('fullname') }}"></label><br>
            <label>Front Title: <input type="text" name="fronttitle" value="{{ old('fronttitle') }}"></label><br>
            <label>Back Title: <input type="text" name="backtitle" value="{{ old('backtitle') }}"></label><br>
            <label>Gender:
                <select name="gender" required>
                    <option value="laki-laki" {{ old('gender') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="perempuan" {{ old('gender') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </label><br>
            <label>Education:
                <select name="education" required>
                    <option value="SMA" {{ old('education') == 'SMA' ? 'selected' : '' }}>SMA</option>
                    <option value="D1" {{ old('education') == 'D1' ? 'selected' : '' }}>D1</option>
                    <option value="D2" {{ old('education') == 'D2' ? 'selected' : '' }}>D2</option>
                    <option value="D3" {{ old('education') == 'D3' ? 'selected' : '' }}>D3</option>
                    <option value="S1" {{ old('education') == 'S1' ? 'selected' : '' }}>S1</option>
                    <option value="S2" {{ old('education') == 'S2' ? 'selected' : '' }}>S2</option>
                    <option value="S3" {{ old('education') == 'S3' ? 'selected' : '' }}>S3</option>
                </select>
            </label><br>
            <label>Contact: <input type="text" name="contact" required value="{{ old('contact') }}"></label><br>
            <label>Email: <input type="email" name="email" required value="{{ old('email') }}"></label><br>
            <label>Address:
                <textarea name="address" required>{{ old('address') }}</textarea>
            </label><br>
            <label>Birth Place: <input type="text" name="place_of_birth" required
                    value="{{ old('place_of_birth') }}"></label><br>
            <label>Birth Date: <input type="date" name="birthdate" required
                    value="{{ old('birthdate') }}"></label><br>
            <label>NPWP: <input type="text" name="npwp" required value="{{ old('npwp') }}"></label><br>
            <label>Marital Status:
                <select name="marital_status" required>
                    <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>Single</option>
                    <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>Married</option>
                    <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>Divorced
                    </option>
                    <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>Widowed</option>
                </select>
            </label><br>
            <label>Photo: <input type="file" name="photo" accept="image/*" required></label><br>
            <button type="submit">Save</button>
            <button type="button"
                onclick="document.getElementById('addEmployeeForm').style.display='none'">Cancel</button>
        </form>
    </div>

    <script>
        function editEmployee(id) {
            window.location.href = '/employee/' + id + '/edit';
        }

        function deleteEmployee(id) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '/employee/' + id;

            var methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';

            var tokenInput = document.createElement('input');
            tokenInput.type = 'hidden';
            tokenInput.name = '_token';
            tokenInput.value = '{{ csrf_token() }}';

            form.appendChild(methodInput);
            form.appendChild(tokenInput);
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>

</html>
