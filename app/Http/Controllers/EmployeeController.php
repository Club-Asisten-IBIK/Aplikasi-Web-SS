<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('employeeid', 'desc')->get();
        return view('finance-management.employee', compact('employees'));
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'npwp' => 'required|string|max:50',
            'marital_status' => 'required|in:single,married,divorced,widowed',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/photos');
            $data['photo'] = basename($path);
        }

        Employee::create($data);

        return redirect()->route('employee.index')->with('success', 'Employee created successfully');
    }

    public function update(Request $request, $employeeid)
    {
        $employee = Employee::findOrFail($employeeid);

        $request->validate([
            'nip' => ['required', 'string', 'max:12', Rule::unique('employee', 'nip')->ignore($employeeid, 'employeeid')],
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
            'npwp' => 'required|string|max:50',
            'marital_status' => 'required|in:single,married,divorced,widowed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            if (!empty($employee->photo) && Storage::exists('public/photos/' . $employee->photo)) {
                Storage::delete('public/photos/' . $employee->photo);
            }
            $path = $request->file('photo')->store('public/photos');
            $data['photo'] = basename($path);
        }

        $employee->update($data);

        return redirect()->route('employee.index')->with('edited', true);
    }

    public function destroy($employeeid)
    {
        $employee = Employee::findOrFail($employeeid);

        if (!empty($employee->photo) && Storage::exists('public/photos/' . $employee->photo)) {
            Storage::delete('public/photos/' . $employee->photo);
        }

        $employee->delete();
        return redirect()->route('employee.index')->with('deleted', true);
    }
}
