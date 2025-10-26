<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function index()
    {
        $userRoles = UserRole::with(['employee', 'parent'])->get();
        return response()->json([
            'status' => 'success',
            'data' => $userRoles
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'userid' => 'required|exists:users,userid',
            'roleid' => 'nullable|exists:role,roleid',
            'employeeid' => 'nullable|exists:employee,employeeid',
            'parentid' => 'nullable|exists:parents,parentid',
        ]);

        $userRole = UserRole::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'UserRole created successfully',
            'data' => $userRole
        ], 201);
    }

    public function show($id)
    {
        $userRole = UserRole::with(['employee', 'parent'])->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $userRole
        ]);
    }

    public function update(Request $request, $id)
    {
        $userRole = UserRole::findOrFail($id);

        $validated = $request->validate([
            'employeeid' => 'required|integer|exists:employee,employeeid',
            'parentid' => 'required|integer|exists:parents,parentid',
        ]);

        $userRole->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'UserRole updated successfully',
            'data' => $userRole
        ]);
    }

    public function destroy($id)
    {
        $userRole = UserRole::findOrFail($id);
        $userRole->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'UserRole deleted successfully'
        ]);
    }
}
