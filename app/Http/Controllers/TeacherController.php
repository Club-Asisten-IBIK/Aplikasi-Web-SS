<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Employee;
use App\Models\Subject;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with(['employee', 'subject'])->get();
        return view('teacher.index', compact('teachers'));
    }

    public function create()
    {
        $employees = Employee::all();
        $subjects = Subject::all();
        return view('teacher.create', compact('employees', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer',
            'subject_id' => 'required|integer',
        ]);

        Teacher::create($request->only(['employee_id', 'subject_id']));
        return redirect()->route('teacher.index')->with('added', true);
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $employees = Employee::all();
        $subjects = Subject::all();
        return view('teacher.edit', compact('teacher', 'employees', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|integer',
            'subject_id' => 'required|integer',
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->update($request->only(['employee_id', 'subject_id']));
        return redirect()->route('teacher.index')->with('edited', true);
    }

    public function destroy($id)
    {
        Teacher::where('teacherid', $id)->delete();
        return redirect()->route('teacher.index')->with('deleted', true);
    }
}
