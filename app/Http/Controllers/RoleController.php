<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    // Tampilkan semua role beserta privilege
    public function index()
    {
        $roles = DB::table('role')
            ->leftJoin('rolepreviledge', 'role.roleid', '=', 'rolepreviledge.roleid')
            ->select(
                'role.roleid',
                'role.rolename',
                'role.isactive',
                'rolepreviledge.read',
                'rolepreviledge.create',
                'rolepreviledge.modify',
                'rolepreviledge.delete'
            )
            ->get();

        return view('user-management.role', compact('roles'));
    }

    // Simpan role baru dan privilege

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'rolename' => 'required|string|max:30',
            'isactive' => 'required|boolean',
        ]);

        // Insert ke tabel role
        $roleid = DB::table('role')->insertGetId([
            'rolename' => $request->rolename,
            'isactive' => $request->isactive,
        ]);

        // Insert ke tabel rolepreviledge
        DB::table('rolepreviledge')->insert([
            'roleid' => $roleid,
            'read'   => $request->has('read') ? 1 : 0,
            'create' => $request->has('create') ? 1 : 0,
            'modify' => $request->has('modify') ? 1 : 0,
            'delete' => $request->has('delete') ? 1 : 0,
        ]);

        return redirect()->route('role.index')->with('success', 'Role berhasil ditambahkan');
    }
    public function destroy($roleid)
    {
        DB::table('rolepreviledge')->where('roleid', $roleid)->delete();
        DB::table('role')->where('roleid', $roleid)->delete();
        return redirect()->route('role.index')->with('deleted', true);
    }

    public function update(Request $request, $roleid)
    {
        // Validasi
        $request->validate([
            'rolename' => 'required|string|max:30',
            'isactive' => 'required|boolean',
        ]);

        // Update tabel role
        DB::table('role')->where('roleid', $roleid)->update([
            'rolename' => $request->rolename,
            'isactive' => $request->isactive,
        ]);

        // Update tabel rolepreviledge
        DB::table('rolepreviledge')->where('roleid', $roleid)->update([
            'read'   => $request->has('read') ? 1 : 0,
            'create' => $request->has('create') ? 1 : 0,
            'modify' => $request->has('modify') ? 1 : 0,
            'delete' => $request->has('delete') ? 1 : 0,
        ]);

        return redirect()->route('role.index')->with('edited', true);
    }
}
