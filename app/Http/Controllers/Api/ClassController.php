<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::with(['teacher', 'teacher.employee'])->get();
        return response()->json([
            'status' => 'success',
            'data' => $classes
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacherid' => 'required|integer',
            'classname' => 'required|string|max:100',
            'gradelevel' => 'required|string',
            'capacity' => 'required|integer',
            'isactive' => 'required|boolean',
        ]);

        $class = ClassModel::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Class created successfully',
            'data' => $class
        ], 201);
    }

    public function show($id)
    {
        $class = ClassModel::with(['teacher', 'teacher.employee'])->findOrFail($id);
        return response()->json($class);
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

        return response()->json($class);
    }

    public function destroy($id)
    {
        $class = ClassModel::findOrFail($id);
        $class->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Class deleted successfully'
        ]);
    }
}
