<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('employeeid', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'data' => $employees
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:12|unique:employee,nip',
            'fullname' => 'required|string|max:100',
            'gender' => 'required|in:laki-laki,perempuan',
            'fronttitle' => 'nullable|string|max:20',
            'backtitle' => 'nullable|string|max:20',
            'education' => 'required|in:SMA,D1,D2,D3,S1,S2,S3',
            'contact' => 'required|string|max:16',
            'email' => 'required|email|max:100',
            'address' => 'required|string|max:255',
            'place_of_birth' => 'required|string|max:50',
            'birthdate' => 'required|date',
            'photo' => 'nullable|string|max:255',
            'npwp' => 'required|string|max:50',
            'marital_status' => 'required|in:single,married,divorced,widowed',
        ]);

        $employee = Employee::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Employee created successfully',
            'data' => $employee
        ], 201);
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $employee
        ]);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'nip' => ['required', 'string', 'max:12', Rule::unique('employee', 'nip')->ignore($id, 'employeeid')],
            'fullname' => 'required|string|max:100',
            'gender' => 'required|in:laki-laki,perempuan',
            'fronttitle' => 'nullable|string|max:20',
            'backtitle' => 'nullable|string|max:20',
            'education' => 'required|in:SMA,D1,D2,D3,S1,S2,S3',
            'contact' => 'required|string|max:16',
            'email' => 'required|email|max:100',
            'address' => 'required|string|max:255',
            'place_of_birth' => 'required|string|max:50',
            'birthdate' => 'required|date',
            'photo' => 'nullable|string|max:255',
            'npwp' => 'required|string|max:50',
            'marital_status' => 'required|in:single,married,divorced,widowed',
        ]);

        $employee->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Employee updated successfully',
            'data' => $employee
        ]);
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Employee deleted successfully'
        ]);
    }
}
