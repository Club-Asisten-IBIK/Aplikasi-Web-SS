<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\Guardian;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::with('guardian')->get();
        return view('class.index', compact('classes'));
    }

    public function create()
    {
        $guardians = Guardian::all();
        return view('class.create', compact('guardians'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guardianid' => 'required|integer',
            'classname' => 'required|string|max:100',
            'gradelevel' => 'required|string',
            'capacity' => 'required|integer',
            'isactive' => 'required|boolean',
        ]);

        ClassModel::create($request->only([
            'guardianid',
            'classname',
            'gradelevel',
            'capacity',
            'isactive'
        ]));

        return redirect()->route('class.index')->with('added', true);
    }

    public function show($id)
    {
        $class = ClassModel::with('guardian')->findOrFail($id);
        return view('class.show', compact('class'));
    }

    public function edit($id)
    {
        $class = ClassModel::findOrFail($id);
        $guardians = Guardian::all();
        return view('class.edit', compact('class', 'guardians'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'guardianid' => 'required|integer',
            'classname' => 'required|string|max:100',
            'gradelevel' => 'required|string',
            'capacity' => 'required|integer',
            'isactive' => 'required|boolean',
        ]);

        $class = ClassModel::findOrFail($id);
        $class->update($request->only([
            'guardianid',
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
