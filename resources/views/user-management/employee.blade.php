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
                        <th style="width:40px;"><input type="checkbox"></th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Joining Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td><input type="checkbox"></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://randomuser.me/api/portraits/men/1.jpg" class="avatar" alt="">
                                <div>
                                    <div class="fw-semibold">Muhammad Alfan</div>
                                    <div class="text-secondary small">YPSS-PDSS-001</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="chip teacher">Teacher</span>
                            <span class="chip staff">Staff</span>
                        </td>
                        <td>Male</td>
                        <td>July 5, 2005</td>
                        <td>July 5, 2024</td>
                        <td>
                            <button class="icon-btn edit"><i class="bi bi-pencil"></i></button>
                            <button class="icon-btn delete"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://randomuser.me/api/portraits/women/2.jpg" class="avatar" alt="">
                                <div>
                                    <div class="fw-semibold">KatarinaAndrea123</div>
                                    <div class="text-secondary small">212310017@gmail.com</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="chip staff">Staff</span>
                        </td>
                        <td>Female</td>
                        <td>July 5, 2005</td>
                        <td>July 5, 2024</td>
                        <td>
                            <button class="icon-btn edit"><i class="bi bi-pencil"></i></button>
                            <button class="icon-btn delete"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://randomuser.me/api/portraits/men/3.jpg" class="avatar" alt="">
                                <div>
                                    <div class="fw-semibold">EcaAgipali</div>
                                    <div class="text-secondary small">212310017@gmail.com</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="chip mentor">Mentor</span>
                        </td>
                        <td>Male</td>
                        <td>July 5, 2005</td>
                        <td>July 5, 2024</td>
                        <td>
                            <button class="icon-btn edit"><i class="bi bi-pencil"></i></button>
                            <button class="icon-btn delete"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://randomuser.me/api/portraits/women/4.jpg" class="avatar" alt="">
                                <div>
                                    <div class="fw-semibold">MhmdAlfan1502</div>
                                    <div class="text-secondary small">212310017@gmail.com</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="chip teacher">Teacher</span>
                        </td>
                        <td>Female</td>
                        <td>July 5, 2005</td>
                        <td>July 5, 2024</td>
                        <td>
                            <button class="icon-btn edit"><i class="bi bi-pencil"></i></button>
                            <button class="icon-btn delete"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://randomuser.me/api/portraits/women/5.jpg" class="avatar" alt="">
                                <div>
                                    <div class="fw-semibold">KatarinaAndrea123</div>
                                    <div class="text-secondary small">212310017@gmail.com</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="chip staff">Staff</span>
                        </td>
                        <td>Male</td>
                        <td>July 5, 2005</td>
                        <td>July 5, 2024</td>
                        <td>
                            <button class="icon-btn edit"><i class="bi bi-pencil"></i></button>
                            <button class="icon-btn delete"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://randomuser.me/api/portraits/men/6.jpg" class="avatar" alt="">
                                <div>
                                    <div class="fw-semibold">EcaAgipali</div>
                                    <div class="text-secondary small">212310017@gmail.com</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="chip mentor">Mentor</span>
                        </td>
                        <td>Male</td>
                        <td>July 5, 2005</td>
                        <td>July 5, 2024</td>
                        <td>
                            <button class="icon-btn edit"><i class="bi bi-pencil"></i></button>
                            <button class="icon-btn delete"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://randomuser.me/api/portraits/women/7.jpg" class="avatar" alt="">
                                <div>
                                    <div class="fw-semibold">MhmdAlfan1502</div>
                                    <div class="text-secondary small">212310017@gmail.com</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="chip teacher">Teacher</span>
                        </td>
                        <td>Female</td>
                        <td>July 5, 2005</td>
                        <td>July 5, 2024</td>
                        <td>
                            <button class="icon-btn edit"><i class="bi bi-pencil"></i></button>
                            <button class="icon-btn delete"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://randomuser.me/api/portraits/women/8.jpg" class="avatar" alt="">
                                <div>
                                    <div class="fw-semibold">KatarinaAndrea123</div>
                                    <div class="text-secondary small">212310017@gmail.com</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="chip staff">Staff</span>
                        </td>
                        <td>Male</td>
                        <td>July 5, 2005</td>
                        <td>July 5, 2024</td>
                        <td>
                            <button class="icon-btn edit"><i class="bi bi-pencil"></i></button>
                            <button class="icon-btn delete"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://randomuser.me/api/portraits/men/9.jpg" class="avatar" alt="">
                                <div>
                                    <div class="fw-semibold">EcaAgipali</div>
                                    <div class="text-secondary small">212310017@gmail.com</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="chip mentor">Mentor</span>
                        </td>
                        <td>Male</td>
                        <td>July 5, 2005</td>
                        <td>July 5, 2024</td>
                        <td>
                            <button class="icon-btn edit"><i class="bi bi-pencil"></i></button>
                            <button class="icon-btn delete"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://randomuser.me/api/portraits/men/10.jpg" class="avatar" alt="">
                                <div>
                                    <div class="fw-semibold">Adrian Adhari</div>
                                    <div class="text-secondary small">Headmaster</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="chip headmaster">Headmaster</span>
                        </td>
                        <td>Female</td>
                        <td>July 5, 2005</td>
                        <td>08957293759</td>
                        <td>
                            <button class="icon-btn edit"><i class="bi bi-pencil"></i></button>
                            <button class="icon-btn delete"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://randomuser.me/api/portraits/women/11.jpg" class="avatar"
                                    alt="">
                                <div>
                                    <div class="fw-semibold">Risma Handayani</div>
                                    <div class="text-secondary small">Teacher</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="chip teacher">Teacher</span>
                        </td>
                        <td>Male</td>
                        <td>July 5, 2005</td>
                        <td>08957293759</td>
                        <td>
                            <button class="icon-btn edit"><i class="bi bi-pencil"></i></button>
                            <button class="icon-btn delete"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Modal Add Employee -->
            <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4" style="background:#fff4f4;">
                        <div class="modal-header border-0">
                            <h5 class="modal-title fw-bold" id="addEmployeeLabel">ADD EMPLOYEE</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form>
                            <div class="modal-body">
                                <div class="d-flex flex-column align-items-center mb-3">
                                    <div class="position-relative">
                                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Avatar"
                                            width="120" height="120" class="rounded-circle bg-white border">
                                        <button type="button"
                                            class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle"
                                            style="background:#3b82f6;">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3 fw-bold">Personal Information</div>
                                <div class="mb-2 row align-items-center">
                                    <label class="col-4 col-form-label fw-semibold">Fullname</label>
                                    <div class="col-1 text-end">:</div>
                                    <div class="col-7"><input type="text" class="form-control"
                                            placeholder="Fullname">
                                    </div>
                                </div>
                                <div class="mb-2 row align-items-center">
                                    <label class="col-4 col-form-label fw-semibold">Status</label>
                                    <div class="col-1 text-end">:</div>
                                    <div class="col-7">
                                        <select class="form-select">
                                            <option>Laki-laki</option>
                                            <option>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-2 row align-items-center">
                                    <label class="col-4 col-form-label fw-semibold">Fronttitle</label>
                                    <div class="col-1 text-end">:</div>
                                    <div class="col-7"><input type="text" class="form-control"
                                            placeholder="Fronttitle"></div>
                                </div>
                                <div class="mb-2 row align-items-center">
                                    <label class="col-4 col-form-label fw-semibold">Backtitle</label>
                                    <div class="col-1 text-end">:</div>
                                    <div class="col-7"><input type="text" class="form-control" placeholder="Role">
                                    </div>
                                </div>
                                <div class="mb-2 row align-items-center">
                                    <label class="col-4 col-form-label fw-semibold">Contact</label>
                                    <div class="col-1 text-end">:</div>
                                    <div class="col-7"><input type="text" class="form-control"
                                            placeholder="Contact"></div>
                                </div>
                                <div class="mb-2 row align-items-center">
                                    <label class="col-4 col-form-label fw-semibold">Email</label>
                                    <div class="col-1 text-end">:</div>
                                    <div class="col-7"><input type="text" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="mb-2 row align-items-center">
                                    <label class="col-4 col-form-label fw-semibold">Addres</label>
                                    <div class="col-1 text-end">:</div>
                                    <div class="col-7"><input type="text" class="form-control"
                                            placeholder="Address">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0 justify-content-end">
                                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal"
                                    style="background:#6c6c6c;">Cancel</button>
                                <button type="submit" class="btn btn-primary px-4"
                                    style="background:#3b82f6;">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Success Modal -->
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
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
                        <div class="fw-semibold text-secondary" style="font-size:1.2rem;">Tambahkan Berhasil</div>
                    </div>
                </div>
            </div>

            <!-- Script to show success modal after submit -->
            @push('scripts')
                <script>
                    document.querySelector('#addEmployeeModal form').addEventListener('submit', function(e) {
                        e.preventDefault();
                        var addModal = bootstrap.Modal.getInstance(document.getElementById('addEmployeeModal'));
                        addModal.hide();
                        setTimeout(function() {
                            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                            successModal.show();
                            setTimeout(function() {
                                successModal.hide();
                            }, 1500);
                        }, 400);
                    });
                </script>
            @endpush
        </div>
    </div>
@endsection
