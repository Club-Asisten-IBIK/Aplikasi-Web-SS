<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRoleController extends Controller
{
    // Tampilkan semua user beserta nama role-nya
    public function index()
    {
        $userRoles = DB::table('users')
            ->join('userrole', 'users.userid', '=', 'userrole.userid')
            ->join('role', 'userrole.roleid', '=', 'role.roleid')
            ->select(
                'users.userid',
                'users.username',
                'users.isactive',
                'role.roleid',
                'role.rolename'
            )
            ->get();

        // Untuk dropdown user dan role (jika ingin tambah/edit)
        $users = DB::table('users')->get();
        $roles = DB::table('role')->where('isactive', 1)->get();

        return view('user-management.user-role', compact('userRoles', 'users', 'roles'));
    }

    // Form tambah user-role
    public function create()
    {
        $users = DB::table('users')->get();
        $roles = DB::table('role')->where('isactive', 1)->get();
        return view('user-management.user-role-create', compact('users', 'roles'));
    }

    // Simpan user-role baru
    public function store(Request $request)
    {
        $request->validate([
            'userid' => 'required|integer|exists:users,userid',
            'roleid' => 'required|integer|exists:role,roleid',
        ]);

        DB::table('userrole')->insert([
            'userid' => $request->userid,
            'roleid' => $request->roleid,
        ]);

        return redirect()->route('user-role.index')->with('success', 'User Role berhasil ditambahkan.');
    }

    // Form edit user-role
    public function edit($userid)
    {
        $userRole = DB::table('userrole')->where('userid', $userid)->first();
        $users = DB::table('users')->get();
        $roles = DB::table('role')->where('isactive', 1)->get();
        return view('user-management.user-role-edit', compact('userRole', 'users', 'roles'));
    }

    // Update user-role
    public function update(Request $request, $userid)
    {
        $request->validate([
            'roleid' => 'required|integer|exists:role,roleid',
        ]);

        DB::table('userrole')->where('userid', $userid)->update([
            'roleid' => $request->roleid,
        ]);

        return redirect()->route('user-role.index')->with('success', 'User Role berhasil diupdate.');
    }

    // Hapus user-role
    public function destroy($userid)
    {
        DB::table('userrole')->where('userid', $userid)->delete();
        return redirect()->route('user-role.index')->with('success', 'User Role berhasil dihapus.');
    }
}
