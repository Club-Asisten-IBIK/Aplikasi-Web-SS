{{-- @extends('layouts.index')

@section('title', 'User Management')

@section('content')
    <div class="dashboard-container">
        @include('layouts.topbar.topbar', [
            'breadcrumb' => ['User Management', 'Role'],
            'title' => 'User Management',
            'subtitle' => 'Manage your team members and their account permission here.',
        ])
        <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
            <div class="fw-bold" style="font-size:1.1rem;">All users <span class="text-secondary fw-normal">55</span></div>
            <div class="d-flex gap-2">
                <div class="input-group" style="width:220px;">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control border-start-0" placeholder="Search">
                </div>
                <button class="btn btn-outline-secondary px-3">Filter</button>
                <button class="btn btn-dark px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                    <i class="bi bi-plus-lg me-2"></i>Add Role
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-role align-middle">
                <thead>
                    <tr>
                        <th style="width:40px;"><input type="checkbox"></th>
                        <th>Role</th>
                        <th>Menus</th>
                        <th>User Akses</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ $role->rolename }}</td>
                            <td>
                                @if ($role->read && $role->create && $role->modify && $role->delete)
                                    <span class="chip-menu red">All Menus</span>
                                @else
                                    @if ($role->read)
                                        <span class="chip-menu green">Read</span>
                                    @endif
                                    @if ($role->create)
                                        <span class="chip-menu blue">Create</span>
                                    @endif
                                    @if ($role->modify)
                                        <span class="chip-menu blue">Modify</span>
                                    @endif
                                    @if ($role->delete)
                                        <span class="chip-menu red">Delete</span>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if ($role->read && !$role->create && !$role->modify && !$role->delete)
                                    View Only
                                @elseif($role->read && $role->create && $role->modify && $role->delete)
                                    All Access
                                @else
                                    @php
                                        $akses = [];
                                        if ($role->read) {
                                            $akses[] = 'Read';
                                        }
                                        if ($role->create) {
                                            $akses[] = 'Create';
                                        }
                                        if ($role->modify) {
                                            $akses[] = 'Modify';
                                        }
                                        if ($role->delete) {
                                            $akses[] = 'Delete';
                                        }
                                    @endphp
                                    {{ implode(', ', $akses) }}
                                @endif
                            </td>
                            <td>
                                <button class="icon-btn edit" data-roleid="{{ $role->roleid }}"
                                    data-rolename="{{ $role->rolename }}" data-isactive="{{ $role->isactive }}"
                                    data-read="{{ $role->read }}" data-create="{{ $role->create }}"
                                    data-modify="{{ $role->modify }}" data-delete="{{ $role->delete }}"
                                    data-bs-toggle="modal" data-bs-target="#editRoleModal">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="icon-btn delete" data-roleid="{{ $role->roleid }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Add Role (menyesuaikan struktur tabel role & rolepreviledge) -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4" style="background:#fff4f4;">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="addRoleLabel">ADD ROLE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('role.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 fw-bold">Role Information</div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-4 col-form-label fw-semibold">Role Name</label>
                            <div class="col-1 text-end">:</div>
                            <div class="col-7">
                                <input type="text" class="form-control" name="rolename" placeholder="Role Name" required>
                            </div>
                        </div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-4 col-form-label fw-semibold">Is Active</label>
                            <div class="col-1 text-end">:</div>
                            <div class="col-7">
                                <select class="form-select" name="isactive">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 fw-bold mt-4">Role Privileges</div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-4 col-form-label fw-semibold">Read</label>
                            <div class="col-1 text-end">:</div>
                            <div class="col-7">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="read" checked>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-4 col-form-label fw-semibold">Create</label>
                            <div class="col-1 text-end">:</div>
                            <div class="col-7">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="create">
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-4 col-form-label fw-semibold">Modify</label>
                            <div class="col-1 text-end">:</div>
                            <div class="col-7">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="modify">
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-4 col-form-label fw-semibold">Delete</label>
                            <div class="col-1 text-end">:</div>
                            <div class="col-7">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="delete">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 justify-content-end">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal"
                            style="background:#6c6c6c;">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4" style="background:#3b82f6;">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 text-center p-4" style="border:0;">
                <div class="mb-3">
                    <div class="d-flex justify-content-center">
                        <span class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width:90px;height:90px;background:#6ee36b;">
                            <i class="bi bi-check-lg" style="font-size:2.5rem;color:#fff;"></i>
                        </span>
                    </div>
                </div>
                <div class="fw-semibold text-secondary" style="font-size:1.2rem;">Tambahkan Berhasil</div>
            </div>
        </div>
    </div>
    <!-- Script to show success modal after submit -->
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('#addRoleModal form');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const addModal = bootstrap.Modal.getInstance(document.getElementById('addRoleModal'));
                        addModal.hide();
                        setTimeout(function() {
                            const successModal = new bootstrap.Modal(document.getElementById(
                                'successModal'));
                            successModal.show();
                            setTimeout(function() {
                                successModal.hide();
                                form.submit();
                            }, 1200);
                        }, 400);
                    });
                }
            });
        </script>
    @endpush
    <!-- Modal Konfirmasi Delete -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 text-center p-4" style="border:0; background:#fff4f4;">
                <div class="mb-3">
                    <i class="bi bi-trash" style="font-size:2.5rem;color:#c63e42;"></i>
                </div>
                <div class="fw-semibold text-secondary mb-4" style="font-size:1.2rem;">
                    Apakah anda yakin ingin menghapusnya
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <form id="deleteRoleForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn px-4" style="background:#c63e42;color:#fff;">Delete</button>
                    </form>
                    <button type="button" class="btn px-4" style="background:#6c6c6c;color:#fff;"
                        data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Sukses Delete -->
    <div class="modal fade" id="successDeleteModal" tabindex="-1" aria-labelledby="successDeleteLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 text-center p-4" style="border:0;">
                <div class="mb-3">
                    <div class="d-flex justify-content-center">
                        <span class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width:90px;height:90px;background:#6ee36b;">
                            <i class="bi bi-check-lg" style="font-size:2.5rem;color:#fff;"></i>
                        </span>
                    </div>
                </div>
                <div class="fw-semibold text-secondary" style="font-size:1.2rem;">Hapus Berhasil</div>
            </div>
        </div>
    </div>
    <!-- Modal Edit Role -->
    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4" style="background:#fff4f4;">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="editRoleLabel">EDIT ROLE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editRoleForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3 fw-bold">Role Information</div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-4 col-form-label fw-semibold">Role Name</label>
                            <div class="col-1 text-end">:</div>
                            <div class="col-7">
                                <input type="text" class="form-control" name="rolename" id="editRoleName" required>
                            </div>
                        </div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-4 col-form-label fw-semibold">Is Active</label>
                            <div class="col-1 text-end">:</div>
                            <div class="col-7">
                                <select class="form-select" name="isactive" id="editIsActive">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 fw-bold mt-4">Role Privileges</div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-4 col-form-label fw-semibold">Read</label>
                            <div class="col-1 text-end">:</div>
                            <div class="col-7">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="read" id="editRead">
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-4 col-form-label fw-semibold">Create</label>
                            <div class="col-1 text-end">:</div>
                            <div class="col-7">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="create" id="editCreate">
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-4 col-form-label fw-semibold">Modify</label>
                            <div class="col-1 text-end">:</div>
                            <div class="col-7">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="modify" id="editModify">
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-4 col-form-label fw-semibold">Delete</label>
                            <div class="col-1 text-end">:</div>
                            <div class="col-7">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="delete" id="editDelete">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 justify-content-end">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal"
                            style="background:#6c6c6c;">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4" style="background:#3b82f6;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Sukses Edit -->
    <div class="modal fade" id="successEditModal" tabindex="-1" aria-labelledby="successEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 text-center p-4" style="border:0;">
                <div class="mb-3">
                    <div class="d-flex justify-content-center">
                        <span class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width:90px;height:90px;background:#6ee36b;">
                            <i class="bi bi-check-lg" style="font-size:2.5rem;color:#fff;"></i>
                        </span>
                    </div>
                </div>
                <div class="fw-semibold text-secondary" style="font-size:1.2rem;">Edit Berhasil</div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            // Edit button click
            document.querySelectorAll('.icon-btn.edit').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var roleId = this.getAttribute('data-roleid');
                    var form = document.getElementById('editRoleForm');
                    form.action = '/role/' + roleId;

                    document.getElementById('editRoleName').value = this.getAttribute('data-rolename');
                    document.getElementById('editIsActive').value = this.getAttribute('data-isactive');
                    document.getElementById('editRead').checked = this.getAttribute('data-read') == "1";
                    document.getElementById('editCreate').checked = this.getAttribute('data-create') == "1";
                    document.getElementById('editModify').checked = this.getAttribute('data-modify') == "1";
                    document.getElementById('editDelete').checked = this.getAttribute('data-delete') == "1";
                });
            });

            // Delete button click
            document.querySelectorAll('.icon-btn.delete').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var roleId = this.getAttribute('data-roleid');
                    var form = document.getElementById('deleteRoleForm');
                    form.action = '/role/' + roleId;
                    var modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
                    modal.show();
                });
            });

            // After delete, show success modal (handle in controller with session)
            @if (session('deleted'))
                setTimeout(function() {
                    var modal = new bootstrap.Modal(document.getElementById('successDeleteModal'));
                    modal.show();
                    setTimeout(function() {
                        modal.hide();
                    }, 1200);
                }, 400);
            @endif

            // After edit, show success modal (handle in controller with session)
            @if (session('edited'))
                setTimeout(function() {
                    var modal = new bootstrap.Modal(document.getElementById('successEditModal'));
                    modal.show();
                    setTimeout(function() {
                        modal.hide();
                    }, 1200);
                }, 400);
            @endif
        </script>
    @endpush
@endsection --}}


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Management</title>
</head>

<body>
    <h1>Role Management</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <button onclick="document.getElementById('addRoleForm').style.display='block'">Add New Role</button>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Role Name</th>
                <th>Status</th>
                <th>Privileges</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->rolename }}</td>
                    <td>{{ $role->isactive ? 'Active' : 'Inactive' }}</td>
                    <td>
                        Read: {{ $role->read ? 'Yes' : 'No' }} |
                        Create: {{ $role->create ? 'Yes' : 'No' }} |
                        Modify: {{ $role->modify ? 'Yes' : 'No' }} |
                        Delete: {{ $role->delete ? 'Yes' : 'No' }}
                    </td>
                    <td>
                        <button
                            onclick="editRole({{ $role->roleid }}, '{{ $role->rolename }}', {{ $role->isactive }})">Edit</button>
                        <button
                            onclick="if(confirm('Delete this role?')) deleteRole({{ $role->roleid }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Add Role Form -->
    <div id="addRoleForm" style="display:none;">
        <h2>Add New Role</h2>
        <form action="{{ route('role.store') }}" method="POST">
            @csrf
            <table>
                <tr>
                    <td>Role Name:</td>
                    <td><input type="text" name="rolename" required maxlength="30"></td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="isactive">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Privileges:</strong></td>
                </tr>
                <tr>
                    <td>Read:</td>
                    <td><input type="checkbox" name="read" value="1"></td>
                </tr>
                <tr>
                    <td>Create:</td>
                    <td><input type="checkbox" name="create" value="1"></td>
                </tr>
                <tr>
                    <td>Modify:</td>
                    <td><input type="checkbox" name="modify" value="1"></td>
                </tr>
                <tr>
                    <td>Delete:</td>
                    <td><input type="checkbox" name="delete" value="1"></td>
                </tr>
            </table>
            <br>
            <button type="submit">Save</button>
            <button type="button" onclick="document.getElementById('addRoleForm').style.display='none'">Cancel</button>
        </form>
    </div>

    <!-- Edit Role Form -->
    <div id="editRoleForm" style="display:none;">
        <h2>Edit Role</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="editRoleId" name="roleid">
            <table>
                <tr>
                    <td>Role Name:</td>
                    <td><input type="text" id="editRoleName" name="rolename" required maxlength="30"></td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <select id="editIsActive" name="isactive">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Privileges:</strong></td>
                </tr>
                <tr>
                    <td>Read:</td>
                    <td><input type="checkbox" id="editRead" name="read" value="1"></td>
                </tr>
                <tr>
                    <td>Create:</td>
                    <td><input type="checkbox" id="editCreate" name="create" value="1"></td>
                </tr>
                <tr>
                    <td>Modify:</td>
                    <td><input type="checkbox" id="editModify" name="modify" value="1"></td>
                </tr>
                <tr>
                    <td>Delete:</td>
                    <td><input type="checkbox" id="editDelete" name="delete" value="1"></td>
                </tr>
            </table>
            <br>
            <button type="submit">Update</button>
            <button type="button"
                onclick="document.getElementById('editRoleForm').style.display='none'">Cancel</button>
        </form>
    </div>

    <script>
        function editRole(id, name, isactive) {
            document.getElementById('editRoleForm').style.display = 'block';
            document.getElementById('editRoleId').value = id;
            document.getElementById('editRoleName').value = name;
            document.getElementById('editIsActive').value = isactive;
            document.getElementById('editForm').action = '/role/' + id;
        }

        function deleteRole(id) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '/role/' + id;

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
