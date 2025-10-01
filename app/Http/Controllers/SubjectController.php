<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('teachers.employee')->get();
        return view('subject.index', compact('subjects'));
    }

    public function create()
    {
        return view('subject.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:20|unique:subject,code',
            'name' => 'required|string|max:100',
            'gradelevel' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        Subject::create($request->all());
        return redirect()->route('subject.index')->with('added', true);
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return view('subject.edit', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|string|max:20|unique:subject,code,' . $id . ',subjectid',
            'name' => 'required|string|max:100',
            'gradelevel' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update($request->all());
        return redirect()->route('subject.index')->with('edited', true);
    }

    public function destroy($id)
    {
        Subject::where('subjectid', $id)->delete();
        return redirect()->route('subject.index')->with('deleted', true);
    }
}
