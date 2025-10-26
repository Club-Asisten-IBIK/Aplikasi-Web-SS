<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        try {
            $teachers = Teacher::with(['employee', 'subject'])->get();
            return response()->json([
                'status' => 'success',
                'data' => $teachers
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'employee_id' => 'required|integer|exists:employee,employeeid',
                'subject_id' => 'required|integer|exists:subject,subjectid',
            ]);

            $teacher = Teacher::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Teacher created successfully',
                'data' => $teacher->load(['employee', 'subject'])
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
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
