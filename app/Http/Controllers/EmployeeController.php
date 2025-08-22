<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = DB::table('employee')->get();
        return view('finance-management.employee', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:100',
            'gender' => 'required|string',
            'fronttitle' => 'nullable|string',
            'backtitle' => 'nullable|string',
            'contact' => 'nullable|string',
            'email' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        DB::table('employee')->insert([
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'fronttitle' => $request->fronttitle,
            'backtitle' => $request->backtitle,
            'contact' => $request->contact,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        return redirect()->route('employee.index')->with('added', true);
    }

    public function update(Request $request, $employeeid)
    {
        $request->validate([
            'fullname' => 'required|string|max:100',
            'gender' => 'required|string',
            'fronttitle' => 'nullable|string',
            'backtitle' => 'nullable|string',
            'contact' => 'nullable|string',
            'email' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        DB::table('employee')->where('employeeid', $employeeid)->update([
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'fronttitle' => $request->fronttitle,
            'backtitle' => $request->backtitle,
            'contact' => $request->contact,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        return redirect()->route('employee.index')->with('edited', true);
    }

    public function destroy($employeeid)
    {
        DB::table('employee')->where('employeeid', $employeeid)->delete();
        return redirect()->route('employee.index')->with('deleted', true);
    }
}
