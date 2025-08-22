<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index()
    {
        $users = DB::table('users')->get();
        $roles = DB::table('role')->where('isactive', 1)->get();
        return view('user-management.user', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100',
            'password' => 'required|string',
            'roleid'   => 'required|integer',
            'isactive' => 'required|boolean',
        ]);

        $userid = DB::table('users')->insertGetId([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'isactive' => $request->isactive,
        ]);

        DB::table('userrole')->insert([
            'userid' => $userid,
            'roleid' => $request->roleid,
        ]);

        return redirect()->route('user.index')->with('added', true);
    }

    public function update(Request $request, $userid)
    {
        $request->validate([
            'username' => 'required|string|max:100',
            'roleid'   => 'required|integer',
            'isactive' => 'required|boolean',
        ]);

        $updateData = [
            'username' => $request->username,
            'isactive' => $request->isactive,
        ];
        if ($request->filled('password')) {
            $updateData['password'] = bcrypt($request->password);
        }

        DB::table('users')->where('userid', $userid)->update($updateData);

        DB::table('userrole')->updateOrInsert(
            ['userid' => $userid],
            ['roleid' => $request->roleid]
        );

        return redirect()->route('user.index')->with('edited', true);
    }

    public function destroy($userid)
    {
        DB::table('userrole')->where('userid', $userid)->delete();
        DB::table('users')->where('userid', $userid)->delete();
        return redirect()->route('user.index')->with('deleted', true);
    }
}
