<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use App\Models\Employee;
use App\Models\ParentModel;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function index()
    {
        // Ambil semua userrole beserta nama employee dan parent
        $userRoles = UserRole::with(['employee', 'parent'])->get();
        return view('user-management.userrole.index', compact('userRoles'));
    }

    public function create()
    {
        $data = [
            'users' => User::orderBy('username')->pluck('username', 'userid'),
            'roles' => Role::orderBy('rolename')->pluck('rolename', 'roleid'),
            'employees' => Employee::orderBy('fullname')->pluck('fullname', 'employeeid'),
            'parents' => ParentModel::orderBy('name')->pluck('name', 'parentid'),
        ];
        return view('user-management.userrole.create', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'userid' => 'required|exists:users,userid',
            'roleid' => 'nullable|exists:role,roleid',
            'employeeid' => 'nullable|exists:employee,employeeid',
            'parentid' => 'nullable|exists:parents,parentid',
        ]);

        UserRole::create($validated);

        return redirect()->route('userrole.index')->with('success', 'UserRole berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // $id bisa berupa array ['userid', 'roleid'] jika pakai composite key
        $userRole = UserRole::findOrFail($id);
        $employees = Employee::all();
        $parents = ParentModel::all();
        return view('user-management.userrole.edit', compact('userRole', 'employees', 'parents'));
    }

    public function update(Request $request, $id)
    {
        $userRole = UserRole::findOrFail($id);

        $validated = $request->validate([
            'employeeid' => 'required|integer|exists:employee,employeeid',
            'parentid' => 'required|integer|exists:parents,parentid',
        ]);

        $userRole->update($validated);

        return redirect()->route('userrole.index')->with('success', 'UserRole berhasil diupdate.');
    }

    public function destroy($id)
    {
        $userRole = UserRole::findOrFail($id);
        $userRole->delete();

        return redirect()->route('userrole.index')->with('success', 'UserRole berhasil dihapus.');
    }
}
