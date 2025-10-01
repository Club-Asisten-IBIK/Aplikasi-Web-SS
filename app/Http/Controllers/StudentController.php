<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ParentModel;
use App\Models\SchoolYear;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['class.guardian', 'parent', 'schoolyear'])->get();
        $schoolyears = SchoolYear::all();
        return view('student-management.student', compact('students', 'schoolyears'));
    }

    public function create()
    {
        $classes = ClassModel::with('guardian')->get();
        return view('student.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schoolyearid' => 'required|integer',
            'classid' => 'required|integer',
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
            'classid',
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
            'classid' => 'required|integer',
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
            'classid',
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

    public function show($id)
    {
        $student = Student::with(['class.guardian', 'parent'])->findOrFail($id);
        return view('student.show', compact('student'));
    }

    public function edit($id)
    {
        $student = Student::with('parent')->findOrFail($id);
        $classes = ClassModel::with('guardian')->get();
        return view('student.edit', compact('student', 'classes'));
    }
}
