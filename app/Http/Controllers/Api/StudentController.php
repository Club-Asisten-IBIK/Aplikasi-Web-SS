<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\ParentModel;
use App\Models\Physical_Records;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        try {
            $students = Student::with([
                'schoolyear',
                'class',
                'class.teacher.employee',
                'parent',
                'physicalRecords'
            ])->get();

            return response()->json([
                'status' => 'success',
                'data' => $students
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
            'schoolyearid' => 'required|exists:schoolyear,schoolyearid',
            'classid' => 'required|exists:class,classid',
            'student_number' => 'required|string|max:20|unique:student,student_number',
            'fullname' => 'required|string|max:50',
            'nickname' => 'nullable|string|max:50',
            'birthplace' => 'required|string|max:50',
            'birthdate' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'religion' => 'required|in:Islam,Kristen,Hindu,Buddha,Konghucu',
            'nationality' => 'required|in:WNI,WNA',
            'siblings_full' => 'nullable|integer|min:0',
            'siblings_step' => 'nullable|integer|min:0',
            'siblings_adopted' => 'nullable|integer|min:0',
            'home_language' => 'nullable|string|max:100',
            'address' => 'required|string',
            'living_with' => 'nullable|in:Orang Tua,Wali,Keluarga Lain',
            'distance_km' => 'nullable|numeric',
            'photo' => 'nullable|string|max:255',
            'status' => 'required|in:prostudent,student,graduated',
            'datejoin' => 'required|date',
            'studentfeeamount' => 'required|numeric',
            'contract' => 'required|string|max:100',
        ]);

        DB::beginTransaction();
        try {
            $input = $request->only([
                'schoolyearid',
                'classid',
                'student_number',
                'fullname',
                'nickname',
                'birthplace',
                'birthdate',
                'gender',
                'religion',
                'nationality',
                'siblings_full',
                'siblings_step',
                'siblings_adopted',
                'home_language',
                'address',
                'living_with',
                'distance_km',
                'photo',
                'status',
                'datejoin',
                'studentfeeamount',
                'contract'
            ]);

            $student = Student::create($input);

            // optional parents (array of parents)
            if ($request->has('parents') && is_array($request->parents)) {
                foreach ($request->parents as $p) {
                    $pdata = array_merge($p, ['studentid' => $student->studentid]);
                    if (!empty($pdata['name'])) {
                        ParentModel::create([
                            'studentid' => $student->studentid,
                            'name' => $pdata['name'],
                            'status' => $pdata['status'] ?? null,
                            'contact' => $pdata['contact'] ?? null,
                            'occupation' => $pdata['occupation'] ?? null,
                            'education' => $pdata['education'] ?? null,
                        ]);
                    }
                }
            }

            // optional physical record
            if ($request->filled('height_cm') || $request->filled('weight_kg') || $request->filled('blood_type') || $request->filled('medical_history')) {
                Physical_Records::create([
                    'studentid' => $student->studentid,
                    'height_cm' => $request->input('height_cm'),
                    'weight_kg' => $request->input('weight_kg'),
                    'blood_type' => $request->input('blood_type'),
                    'medical_history' => $request->input('medical_history'),
                ]);
            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Student created successfully',
                'data' => $student
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
        $student = Student::with([
            'schoolyear',
            'class',
            'class.teacher.employee',
            'parent',
            'physicalRecords'
        ])->findOrFail($id);

        return response()->json($student);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'schoolyearid' => 'required|exists:schoolyear,schoolyearid',
            'classid' => 'required|exists:class,classid',
            'student_number' => 'required|string|max:20|unique:student,student_number,' . $id . ',studentid',
            'fullname' => 'required|string|max:50',
            'nickname' => 'nullable|string|max:50',
            'birthplace' => 'required|string|max:50',
            'birthdate' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'religion' => 'required|in:Islam,Kristen,Hindu,Buddha,Konghucu',
            'nationality' => 'required|in:WNI,WNA',
            'siblings_full' => 'nullable|integer|min:0',
            'siblings_step' => 'nullable|integer|min:0',
            'siblings_adopted' => 'nullable|integer|min:0',
            'home_language' => 'nullable|string|max:100',
            'address' => 'required|string',
            'living_with' => 'nullable|in:Orang Tua,Wali,Keluarga Lain',
            'distance_km' => 'nullable|numeric',
            'photo' => 'nullable|string|max:255',
            'status' => 'required|in:prostudent,student,graduated',
            'datejoin' => 'required|date',
            'studentfeeamount' => 'required|numeric',
            'contract' => 'required|string|max:100',
        ]);

        DB::beginTransaction();
        try {
            $student = Student::findOrFail($id);

            $input = $request->only([
                'schoolyearid',
                'classid',
                'student_number',
                'fullname',
                'nickname',
                'birthplace',
                'birthdate',
                'gender',
                'religion',
                'nationality',
                'siblings_full',
                'siblings_step',
                'siblings_adopted',
                'home_language',
                'address',
                'living_with',
                'distance_km',
                'photo',
                'status',
                'datejoin',
                'studentfeeamount',
                'contract'
            ]);

            $student->update($input);

            // replace parents if provided
            if ($request->has('parents') && is_array($request->parents)) {
                ParentModel::where('studentid', $student->studentid)->delete();
                foreach ($request->parents as $p) {
                    if (!empty($p['name'])) {
                        ParentModel::create([
                            'studentid' => $student->studentid,
                            'name' => $p['name'],
                            'status' => $p['status'] ?? null,
                            'contact' => $p['contact'] ?? null,
                            'occupation' => $p['occupation'] ?? null,
                            'education' => $p['education'] ?? null,
                        ]);
                    }
                }
            }

            // update or create physical record
            if ($request->filled('height_cm') || $request->filled('weight_kg') || $request->filled('blood_type') || $request->filled('medical_history')) {
                $phys = Physical_Records::where('studentid', $student->studentid)->first();
                $physData = [
                    'studentid' => $student->studentid,
                    'height_cm' => $request->input('height_cm'),
                    'weight_kg' => $request->input('weight_kg'),
                    'blood_type' => $request->input('blood_type'),
                    'medical_history' => $request->input('medical_history'),
                ];
                if ($phys) {
                    $phys->update($physData);
                } else {
                    Physical_Records::create($physData);
                }
            }

            DB::commit();
            return response()->json($student);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            ParentModel::where('studentid', $id)->delete();
            Physical_Records::where('studentid', $id)->delete();
            Student::findOrFail($id)->delete();
            DB::commit();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
