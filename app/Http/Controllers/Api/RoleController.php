<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class RoleController extends Controller
{
    // Tampilkan semua role beserta privilege
    public function index()
    {
        try {
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

            return response()->json($roles);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to retrieve roles: ' . $e->getMessage()], 500);
        }
    }

    // Simpan role baru dan privilege
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'rolename' => 'required|string|max:30',
            'isactive' => 'required|boolean',
        ]);

        try {
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

            return response()->json(['message' => 'Role berhasil ditambahkan'], 201);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to create role: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($roleid)
    {
        try {
            DB::table('rolepreviledge')->where('roleid', $roleid)->delete();
            DB::table('role')->where('roleid', $roleid)->delete();
            return response()->json(['message' => 'Role berhasil dihapus'], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to delete role: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $roleid)
    {
        // Validasi
        $request->validate([
            'rolename' => 'required|string|max:30',
            'isactive' => 'required|boolean',
        ]);

        try {
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

            return response()->json(['message' => 'Role berhasil diperbarui'], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to update role: ' . $e->getMessage()], 500);
        }
    }
}
