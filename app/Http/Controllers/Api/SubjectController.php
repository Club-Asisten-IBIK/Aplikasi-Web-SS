<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function index()
    {
        try {
            $subjects = Subject::with('teachers.employee')->get();
            return response()->json([
                'status' => 'success',
                'data' => $subjects
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
        $request->validate([
            'code' => 'required|string|max:20|unique:subject,code',
            'name' => 'required|string|max:100',
            'gradelevel' => 'required|string',
            'is_active' => 'required|boolean',
            'employee_ids' => 'required|array',
            'employee_ids.*' => 'exists:employee,employeeid'
        ]);

        DB::beginTransaction();
        try {
            $subject = Subject::create($request->only([
                'code',
                'name',
                'gradelevel',
                'is_active'
            ]));

            foreach ($request->employee_ids as $employeeId) {
                Teacher::create([
                    'employee_id' => $employeeId,
                    'subject_id' => $subject->subjectid
                ]);
            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Subject created successfully',
                'data' => $subject->load('teachers.employee')
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $subject = Subject::with('teachers.employee')->findOrFail($id);
            return response()->json([
                'status' => 'success',
                'data' => $subject
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|string|max:20|unique:subject,code,' . $id . ',subjectid',
            'name' => 'required|string|max:100',
            'gradelevel' => 'required|string',
            'is_active' => 'required|boolean',
            'employee_ids' => 'required|array',
            'employee_ids.*' => 'exists:employee,employeeid'
        ]);

        DB::beginTransaction();
        try {
            $subject = Subject::findOrFail($id);

            $subject->update($request->only([
                'code',
                'name',
                'gradelevel',
                'is_active'
            ]));

            Teacher::where('subject_id', $subject->subjectid)->delete();
            foreach ($request->employee_ids as $employeeId) {
                Teacher::create([
                    'employee_id' => $employeeId,
                    'subject_id' => $subject->subjectid
                ]);
            }

            DB::commit();
            return response()->json($subject->load('teachers.employee'));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Terjadi kesalahan saat memperbarui data.'], 500);
        }
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return response()->json(null, 204);
    }
}
