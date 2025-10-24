<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        return Teacher::with(['employee', 'subject'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer',
            'subject_id' => 'required|integer',
        ]);

        $teacher = Teacher::create($request->only(['employee_id', 'subject_id']));
        return response()->json($teacher, 201);
    }

    public function show($id)
    {
        $teacher = Teacher::with(['employee', 'subject'])->findOrFail($id);
        return response()->json($teacher);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|integer',
            'subject_id' => 'required|integer',
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->update($request->only(['employee_id', 'subject_id']));
        return response()->json($teacher);
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        return response()->json(null, 204);
    }
}
