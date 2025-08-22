@extends('layouts.index')

@section('title', 'Student Management')

@section('content')
    <div class="dashboard-container">
        <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
            <div class="fw-bold" style="font-size:1.1rem;">All students <span
                    class="text-secondary fw-normal">{{ count($students) }}</span></div>
            <button class="btn btn-dark px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                <i class="bi bi-plus-lg me-2"></i>Add Student
            </button>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>School Year</th>
                        <th>Sex</th>
                        <th>Parent</th>
                        <th>Parent Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->schoolyear->schoolyear ?? '-' }}</td>
                            <td>{{ $student->sex }}</td>
                            <td>{{ $student->parent->name ?? '-' }}</td>
                            <td>{{ $student->parent->contact ?? '-' }}</td>
                            <td>
                                <button class="icon-btn edit" data-studentid="{{ $student->studentid }}"
                                    data-schoolyearid="{{ $student->schoolyearid }}" data-name="{{ $student->name }}"
                                    data-place="{{ $student->place }}" data-birthdate="{{ $student->birthdate }}"
                                    data-sex="{{ $student->sex }}" data-status="{{ $student->status }}"
                                    data-datejoin="{{ $student->datejoin }}"
                                    data-studentfeeamount="{{ $student->studentfeeamount }}"
                                    data-contract="{{ $student->contract }}"
                                    data-parent_name="{{ $student->parent->name ?? '' }}"
                                    data-parent_status="{{ $student->parent->status ?? '' }}"
                                    data-parent_contact="{{ $student->parent->contact ?? '' }}" data-bs-toggle="modal"
                                    data-bs-target="#editStudentModal">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="icon-btn delete" data-studentid="{{ $student->studentid }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Add Student -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4" style="background:#fff4f4;">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="addStudentLabel">ADD STUDENT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('student.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-2">
                            <label>School Year</label>
                            <select name="schoolyearid" class="form-select" required>
                                <option value="">-- Select School Year --</option>
                                @foreach ($schoolyears as $sy)
                                    <option value="{{ $sy->schoolyearid }}">{{ $sy->schoolyear }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Place</label>
                            <input type="text" name="place" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Birthdate</label>
                            <input type="date" name="birthdate" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Sex</label>
                            <select name="sex" class="form-select" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label>Status</label>
                            <input type="text" name="status" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Date Join</label>
                            <input type="date" name="datejoin" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Student Fee Amount</label>
                            <input type="number" name="studentfeeamount" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Contract</label>
                            <input type="text" name="contract" class="form-control">
                        </div>
                        <hr>
                        <div class="mb-2">
                            <label>Parent Name</label>
                            <input type="text" name="parent_name" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Parent Status</label>
                            <input type="text" name="parent_status" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Parent Contact</label>
                            <input type="text" name="parent_contact" class="form-control">
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

    <!-- Modal Edit Student -->
    <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4" style="background:#fff4f4;">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="editStudentLabel">EDIT STUDENT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editStudentForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="studentid" id="editStudentid">
                        <div class="mb-2">
                            <label>School Year</label>
                            <select name="schoolyearid" id="editSchoolyearid" class="form-select" required>
                                <option value="">-- Select School Year --</option>
                                @foreach ($schoolyears as $sy)
                                    <option value="{{ $sy->schoolyearid }}">{{ $sy->schoolyear }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label>Name</label>
                            <input type="text" name="name" id="editName" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Place</label>
                            <input type="text" name="place" id="editPlace" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Birthdate</label>
                            <input type="date" name="birthdate" id="editBirthdate" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Sex</label>
                            <select name="sex" id="editSex" class="form-select" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label>Status</label>
                            <input type="text" name="status" id="editStatus" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Date Join</label>
                            <input type="date" name="datejoin" id="editDatejoin" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Student Fee Amount</label>
                            <input type="number" name="studentfeeamount" id="editStudentfeeamount"
                                class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Contract</label>
                            <input type="text" name="contract" id="editContract" class="form-control">
                        </div>
                        <hr>
                        <div class="mb-2">
                            <label>Parent Name</label>
                            <input type="text" name="parent_name" id="editParentName" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Parent Status</label>
                            <input type="text" name="parent_status" id="editParentStatus" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Parent Contact</label>
                            <input type="text" name="parent_contact" id="editParentContact" class="form-control">
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
                    <form id="deleteStudentForm" method="POST">
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

    @push('scripts')
        <script>
            // Edit button click
            document.querySelectorAll('.icon-btn.edit').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var form = document.getElementById('editStudentForm');
                    var id = this.getAttribute('data-studentid');
                    form.action = '/student/' + id;
                    document.getElementById('editStudentid').value = id;
                    document.getElementById('editSchoolyearid').value = this.getAttribute('data-schoolyearid');
                    document.getElementById('editName').value = this.getAttribute('data-name');
                    document.getElementById('editPlace').value = this.getAttribute('data-place');
                    document.getElementById('editBirthdate').value = this.getAttribute('data-birthdate');
                    document.getElementById('editSex').value = this.getAttribute('data-sex');
                    document.getElementById('editStatus').value = this.getAttribute('data-status');
                    document.getElementById('editDatejoin').value = this.getAttribute('data-datejoin');
                    document.getElementById('editStudentfeeamount').value = this.getAttribute(
                        'data-studentfeeamount');
                    document.getElementById('editContract').value = this.getAttribute('data-contract');
                    document.getElementById('editParentName').value = this.getAttribute('data-parent_name');
                    document.getElementById('editParentStatus').value = this.getAttribute('data-parent_status');
                    document.getElementById('editParentContact').value = this.getAttribute(
                        'data-parent_contact');
                });
            });
            // Delete button click
            document.querySelectorAll('.icon-btn.delete').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var form = document.getElementById('deleteStudentForm');
                    form.action = '/student/' + this.getAttribute('data-studentid');
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
