@extends('layouts.index')

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
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>Yayasan</td>
                        <td>
                            <span class="chip-menu red">All Menus</span>
                        </td>
                        <td>View Only</td>
                        <td>
                            <button class="icon-btn edit"><i class="bi bi-pencil"></i></button>
                            <button class="icon-btn delete"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>Administrator</td>
                        <td>
                            <span class="chip-menu red">All Menus</span>
                        </td>
                        <td>View Only</td>
                        <td>
                            <button class="icon-btn edit"><i class="bi bi-pencil"></i></button>
                            <button class="icon-btn delete"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>Guru</td>
                        <td>
                            <span class="chip-menu blue">Dashboard Guru</span>
                        </td>
                        <td>View Only</td>
                        <td>
                            <button class="icon-btn edit"><i class="bi bi-pencil"></i></button>
                            <button class="icon-btn delete"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>Keuangan</td>
                        <td>
                            <span class="chip-menu green">Finance Management</span>
                            <span class="chip-menu green">Dashboard Finance</span>
                        </td>
                        <td>View Only</td>
                        <td>
                            <button class="icon-btn edit"><i class="bi bi-pencil"></i></button>
                            <button class="icon-btn delete"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
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
                <form>
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
@endsection
