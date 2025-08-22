@extends('layouts.index')

@section('title', 'User Management')

@section('content')
    <div class="dashboard-container">
        @include('layouts.topbar.topbar', [
            'breadcrumb' => ['User Management', 'User'],
            'title' => 'User Management',
            'subtitle' => 'Manage your team members and their account permission here.',
        ])
        <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
            <div class="fw-bold" style="font-size:1.1rem;">All users <span
                    class="text-secondary fw-normal">{{ count($users) }}</span></div>
            <div class="d-flex gap-2">
                <button class="btn btn-dark px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="bi bi-plus-lg me-2"></i>Add User
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-employee align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Is Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td>
                                @php
                                    $role = \DB::table('userrole')
                                        ->join('role', 'userrole.roleid', '=', 'role.roleid')
                                        ->where('userrole.userid', $user->userid)
                                        ->value('role.rolename');
                                @endphp
                                {{ $role ?? '-' }}
                            </td>
                            <td>{{ $user->isactive ? 'Yes' : 'No' }}</td>
                            <td>
                                <button class="icon-btn edit" data-userid="{{ $user->userid }}"
                                    data-username="{{ $user->username }}"
                                    data-roleid="{{ \DB::table('userrole')->where('userid', $user->userid)->value('roleid') }}"
                                    data-isactive="{{ $user->isactive }}" data-bs-toggle="modal"
                                    data-bs-target="#editUserModal">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="icon-btn delete" data-userid="{{ $user->userid }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Add User -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4" style="background:#fff4f4;">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="addUserLabel">ADD USER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-2">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Role</label>
                            <select name="roleid" class="form-select" required>
                                <option value="">-- Select Role --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->roleid }}">{{ $role->rolename }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label>Is Active</label>
                            <select name="isactive" class="form-select">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
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
    <!-- Modal Konfirmasi Delete -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 text-center p-4" style="border:0; background:#fff4f4;">
                <div class="mb-3">
                    <i class="bi bi-trash" style="font-size:2.5rem;color:#c63e42;"></i>
                </div>
                <div class="fw-semibold text-secondary mb-4" style="font-size:1.2rem;">
                    Apakah anda yakin ingin menghapusnya
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <form id="deleteUserForm" method="POST">
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

    <!-- Modal Edit User -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4" style="background:#fff4f4;">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="editUserLabel">EDIT USER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="userid" id="editUserid">
                        <div class="mb-2">
                            <label>Username</label>
                            <input type="text" name="username" id="editUsername" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Password (isi jika ingin ganti)</label>
                            <input type="password" name="password" id="editPassword" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Role</label>
                            <select name="roleid" id="editRoleid" class="form-select" required>
                                <option value="">-- Select Role --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->roleid }}">{{ $role->rolename }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label>Is Active</label>
                            <select name="isactive" id="editIsactive" class="form-select">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
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
                    var userid = this.getAttribute('data-userid');
                    var username = this.getAttribute('data-username');
                    var roleid = this.getAttribute('data-roleid');
                    var isactive = this.getAttribute('data-isactive');
                    var form = document.getElementById('editUserForm');
                    form.action = '/user/' + userid;
                    document.getElementById('editUserid').value = userid;
                    document.getElementById('editUsername').value = username;
                    document.getElementById('editRoleid').value = roleid;
                    document.getElementById('editIsactive').value = isactive;
                });
            });
            // Delete button click
            document.querySelectorAll('.icon-btn.delete').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var form = document.getElementById('deleteUserForm');
                    form.action = '/user/' + this.getAttribute('data-userid');
                    var modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
                    modal.show();
                });
            });

            // Success modals
            @if (session('added'))
                setTimeout(function() {
                    var modal = new bootstrap.Modal(document.getElementById('successModal'));
                    modal.show();
                    setTimeout(function() {
                        modal.hide();
                    }, 1200);
                }, 400);
            @endif
            @if (session('edited'))
                setTimeout(function() {
                    var modal = new bootstrap.Modal(document.getElementById('successEditModal'));
                    modal.show();
                    setTimeout(function() {
                        modal.hide();
                    }, 1200);
                }, 400);
            @endif
            @if (session('deleted'))
                setTimeout(function() {
                    var modal = new bootstrap.Modal(document.getElementById('successDeleteModal'));
                    modal.show();
                    setTimeout(function() {
                        modal.hide();
                    }, 1200);
                }, 400);
            @endif
        </script>
    @endpush
@endsection
