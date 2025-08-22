<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ParentModel;
use App\Models\SchoolYear;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['parent', 'schoolyear'])->get();
        $schoolyears = SchoolYear::all();
        return view('student-management.student', compact('students', 'schoolyears'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schoolyearid' => 'required|integer',
            'name' => 'required|string|max:100',
            'place' => 'nullable|string|max:100',
            'birthdate' => 'nullable|date',
            'sex' => 'required|string',
            'status' => 'nullable|string',
            'datejoin' => 'nullable|date',
            'studentfeeamount' => 'nullable|numeric',
            'contract' => 'nullable|string',
            // Parent
            'parent_name' => 'required|string|max:100',
            'parent_status' => 'nullable|string|max:50',
            'parent_contact' => 'nullable|string|max:50',
        ]);

        $student = Student::create($request->only([
            'schoolyearid',
            'name',
            'place',
            'birthdate',
            'sex',
            'status',
            'datejoin',
            'studentfeeamount',
            'contract'
        ]));

        ParentModel::create([
            'studentid' => $student->studentid,
            'name' => $request->parent_name,
            'status' => $request->parent_status,
            'contact' => $request->parent_contact,
        ]);

        return redirect()->route('student.index')->with('added', true);
    }

    public function update(Request $request, $studentid)
    {
        $request->validate([
            'schoolyearid' => 'required|integer',
            'name' => 'required|string|max:100',
            'place' => 'nullable|string|max:100',
            'birthdate' => 'nullable|date',
            'sex' => 'required|string',
            'status' => 'nullable|string',
            'datejoin' => 'nullable|date',
            'studentfeeamount' => 'nullable|numeric',
            'contract' => 'nullable|string',
            // Parent
            'parent_name' => 'required|string|max:100',
            'parent_status' => 'nullable|string|max:50',
            'parent_contact' => 'nullable|string|max:50',
        ]);

        $student = Student::findOrFail($studentid);
        $student->update($request->only([
            'schoolyearid',
            'name',
            'place',
            'birthdate',
            'sex',
            'status',
            'datejoin',
            'studentfeeamount',
            'contract'
        ]));

        $parent = ParentModel::where('studentid', $studentid)->first();
        if ($parent) {
            $parent->update([
                'name' => $request->parent_name,
                'status' => $request->parent_status,
                'contact' => $request->parent_contact,
            ]);
        } else {
            ParentModel::create([
                'studentid' => $studentid,
                'name' => $request->parent_name,
                'status' => $request->parent_status,
                'contact' => $request->parent_contact,
            ]);
        }

        return redirect()->route('student.index')->with('edited', true);
    }

    public function destroy($studentid)
    {
        ParentModel::where('studentid', $studentid)->delete();
        Student::where('studentid', $studentid)->delete();
        return redirect()->route('student.index')->with('deleted', true);
    }
}
