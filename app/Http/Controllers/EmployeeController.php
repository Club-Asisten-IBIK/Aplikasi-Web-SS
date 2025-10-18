<?php


namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('role')->get();
        $roles = Role::where('isactive', true)->get();
        return view('finance-management.employee', compact('employees', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'roleid' => 'required|exists:role,roleid',
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
            'photo' => 'nullable|string',
            'npwp' => 'required|string|max:50',
            'marital_status' => 'required|in:single,married,divorced,widowed'
        ]);

        Employee::create($request->all());
        return redirect()->route('employee.index')->with('added', true);
    }

    public function update(Request $request, $employeeid)
    {
        $request->validate([
            'roleid' => 'required|exists:role,roleid',
            'nip' => 'required|string|max:12|unique:employee,nip,' . $employeeid . ',employeeid',
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
            'photo' => 'nullable|string',
            'npwp' => 'required|string|max:50',
            'marital_status' => 'required|in:single,married,divorced,widowed'
        ]);

        $employee = Employee::findOrFail($employeeid);
        $employee->update($request->all());
        return redirect()->route('employee.index')->with('edited', true);
    }

    public function destroy($employeeid)
    {
        Employee::findOrFail($employeeid)->delete();
        return redirect()->route('employee.index')->with('deleted', true);
    }
}
