@extends('layouts.index')

@section('title', 'User Management')

@section('content')
    <div class="dashboard-container">
        @include('layouts.topbar.topbar', [
            'breadcrumb' => ['User Management', 'Employee'],
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
                <button class="btn btn-dark px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                    <i class="bi bi-plus-lg me-2"></i>Add User
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-employee align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Front Title</th>
                        <th>Back Title</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->fullname }}</td>
                            <td>{{ $employee->gender }}</td>
                            <td>{{ $employee->fronttitle }}</td>
                            <td>{{ $employee->backtitle }}</td>
                            <td>{{ $employee->contact }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->address }}</td>
                            <td>
                                <button class="icon-btn edit" data-employeeid="{{ $employee->employeeid }}"
                                    data-fullname="{{ $employee->fullname }}" data-gender="{{ $employee->gender }}"
                                    data-fronttitle="{{ $employee->fronttitle }}"
                                    data-backtitle="{{ $employee->backtitle }}" data-contact="{{ $employee->contact }}"
                                    data-email="{{ $employee->email }}" data-address="{{ $employee->address }}"
                                    data-bs-toggle="modal" data-bs-target="#editEmployeeModal">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="icon-btn delete" data-employeeid="{{ $employee->employeeid }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Add Employee -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4" style="background:#fff4f4;">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="addEmployeeLabel">ADD EMPLOYEE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('employee.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 fw-bold">Personal Information</div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-4 col-form-label fw-semibold">Fullname</label>
                            <div class="col-1 text-end">:</div>
                            <div class="col-7">
                                <input type="text" class="form-control" placeholder="Fullname" name="fullname">
                            </div>
                        </div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-4 col-form-label fw-semibold">Status</label>
                            <div class="col-1 text-end">:</div>
                            <div class="col-7">
                                <select class="form-select" name="gender">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-4 col-form-label fw-semibold">Fronttitle</label>
                            <div class="col-1 text-end">:</div>
                            <div class="col-7">
                                <input type="text" class="form-control" placeholder="Fronttitle" name="fronttitle">
                            </div>
                        </div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-4 col-form-label fw-semibold">Backtitle</label>
                            <div class="col-1 text-end">:</div>
                            <div class="col-7">
                                <input type="text" class="form-control" placeholder="Backtitle" name="backtitle">
                            </div>
                        </div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-4 col-form-label fw-semibold">Contact</label>
                            <div class="col-1 text-end">:</div>
                            <div class="col-7">
                                <input type="text" class="form-control" placeholder="Contact" name="contact">
                            </div>
                        </div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-4 col-form-label fw-semibold">Email</label>
                            <div class="col-1 text-end">:</div>
                            <div class="col-7">
                                <input type="text" class="form-control" placeholder="Email" name="email">
                            </div>
                        </div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-4 col-form-label fw-semibold">Address</label>
                            <div class="col-1 text-end">:</div>
                            <div class="col-7">
                                <input type="text" class="form-control" placeholder="Address" name="address">
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
                    <form id="deleteEmployeeForm" method="POST">
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
    <!-- Modal Edit Employee -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4" style="background:#fff4f4;">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="editEmployeeLabel">EDIT EMPLOYEE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editEmployeeForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3 fw-bold">Employee Information</div>
                        <input type="text" name="fullname" id="editFullname" class="form-control mb-2"
                            placeholder="Fullname">
                        <select name="gender" id="editGender" class="form-select mb-2">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <input type="text" name="fronttitle" id="editFronttitle" class="form-control mb-2"
                            placeholder="Fronttitle">
                        <input type="text" name="backtitle" id="editBacktitle" class="form-control mb-2"
                            placeholder="Backtitle">
                        <input type="text" name="contact" id="editContact" class="form-control mb-2"
                            placeholder="Contact">
                        <input type="text" name="email" id="editEmail" class="form-control mb-2"
                            placeholder="Email">
                        <input type="text" name="address" id="editAddress" class="form-control mb-2"
                            placeholder="Address">
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
                    var employeeId = this.getAttribute('data-employeeid');
                    var form = document.getElementById('editEmployeeForm');
                    form.action = '/employee/' + employeeId;
                    document.getElementById('editFullname').value = this.getAttribute('data-fullname');
                    document.getElementById('editGender').value = this.getAttribute('data-gender');
                    document.getElementById('editFronttitle').value = this.getAttribute('data-fronttitle');
                    document.getElementById('editBacktitle').value = this.getAttribute('data-backtitle');
                    document.getElementById('editContact').value = this.getAttribute('data-contact');
                    document.getElementById('editEmail').value = this.getAttribute('data-email');
                    document.getElementById('editAddress').value = this.getAttribute('data-address');
                });
            });

            // Delete button click
            document.querySelectorAll('.icon-btn.delete').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var form = document.getElementById('deleteEmployeeForm');
                    form.action = '/employee/' + this.getAttribute('data-employeeid');
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
