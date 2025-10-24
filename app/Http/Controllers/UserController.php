<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Employee;
use App\Models\ParentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = DB::table('users')
                ->join('userrole', 'users.userid', '=', 'userrole.userid')
                ->leftJoin('employee', 'userrole.employeeid', '=', 'employee.employeeid')
                ->leftJoin('parent', 'userrole.parentid', '=', 'parent.parentid')
                ->leftJoin('role', 'userrole.roleid', '=', 'role.roleid')
                ->select(
                    'users.userid',
                    'users.username',
                    'users.isactive',
                    'userrole.employeeid',
                    'userrole.parentid',
                    'employee.fullname as employee_name',
                    'parent.name as parent_name',
                    'role.rolename'
                )
                ->get();

            return view('user-management.users.index', compact('users'));
        } catch (QueryException $e) {
            return back()->with('error', 'Error fetching users: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            // Remove isactive condition from employee query since column doesn't exist
            $employees = Employee::all();
            $parents = ParentModel::all();
            $roles = Role::where('isactive', 1)->get();

            return view('user-management.users.create', compact('roles', 'employees', 'parents'));
        } catch (QueryException $e) {
            return back()->with('error', 'Error loading form: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6',
            'isactive' => 'required|boolean',
            'type' => 'required|in:employee,parent',
            'roles' => 'required|array',
            'roles.*' => 'exists:role,roleid',
            // employeeid/parentid validasi opsional
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'isactive' => $request->isactive,
            ]);

            foreach ($request->roles as $roleid) {
                DB::table('userrole')->insert([
                    'userid' => $user->userid,
                    'roleid' => $roleid,
                    'employeeid' => $request->type == 'employee' ? $request->employeeid : null,
                    'parentid' => $request->type == 'parent' ? $request->parentid : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();
            return redirect()->route('user.index')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $user = User::with(['roles'])->findOrFail($id);
            $roles = Role::where('isactive', 1)->get();
            $employees = Employee::where('isactive', 1)->get();
            $parents = ParentModel::all();

            return view('user-management.users.edit', compact('user', 'roles', 'employees', 'parents'));
        } catch (QueryException $e) {
            return back()->with('error', 'Error loading user: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $id . ',userid',
            'password' => 'nullable|string|min:6',
            'isactive' => 'required|boolean',
            'type' => 'required|in:employee,parent',
            'employeeid' => 'required_if:type,employee|nullable|exists:employee,employeeid',
            'parentid' => 'required_if:type,parent|nullable|exists:parent,parentid',
            'roles' => 'required|array|exists:role,roleid'
        ]);

        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);

            $updateData = [
                'username' => $request->username,
                'isactive' => $request->isactive,
                'employeeid' => $request->type === 'employee' ? $request->employeeid : null,
                'parentid' => $request->type === 'parent' ? $request->parentid : null,
            ];

            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }

            $user->update($updateData);

            // Sync roles
            $user->roles()->sync($request->roles);

            DB::commit();
            return redirect()->route('user.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Error updating user: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);
            // Detach all roles first
            $user->roles()->detach();
            // Then delete the user
            $user->delete();

            DB::commit();
            return redirect()->route('user.index')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }
}
