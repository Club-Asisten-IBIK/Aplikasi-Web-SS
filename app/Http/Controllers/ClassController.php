<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\Teacher;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::with(['teacher', 'teacher.employee'])->get();
        return view('student-management.class.class', compact('classes'));
    }

    public function create()
    {
        $teachers = Teacher::with('employee')->get();
        return view('student-management.class.class-edit', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacherid' => 'required|integer',
            'classname' => 'required|string|max:100',
            'gradelevel' => 'required|string',
            'capacity' => 'required|integer',
            'isactive' => 'required|boolean',
        ]);

        ClassModel::create($request->only([
            'teacherid',
            'classname',
            'gradelevel',
            'capacity',
            'isactive'
        ]));

        return redirect()->route('class.index')->with('added', true);
    }

    public function show($id)
    {
        $class = ClassModel::with('teacher')->findOrFail($id);
        return view('class.show', compact('class'));
    }

    public function edit($id)
    {
        $class = ClassModel::with('teacher.employee')->findOrFail($id);
        $teachers = Teacher::with('employee')->get();
        return view('student-management.class.class-edit', compact('class', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'teacherid' => 'required|integer',
            'classname' => 'required|string|max:100',
            'gradelevel' => 'required|string',
            'capacity' => 'required|integer',
            'isactive' => 'required|boolean',
        ]);

        $class = ClassModel::findOrFail($id);
        $class->update($request->only([
            'teacherid',
            'classname',
            'gradelevel',
            'capacity',
            'isactive'
        ]));

        return redirect()->route('class.index')->with('edited', true);
    }

    public function destroy($id)
    {
        ClassModel::where('classid', $id)->delete();
        return redirect()->route('class.index')->with('deleted', true);
    }
}
