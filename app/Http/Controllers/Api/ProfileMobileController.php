<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class ProfileMobileController extends Controller
{
    public function getProfile($studentId)
    {
        try {
            $student = Student::with([
                'parent',
                'physicalRecords',
                'class.teacher.employee',
                'schoolyear'
            ])->findOrFail($studentId);

            return response()->json([
                'status' => 'success',
                'data' => [
                    'student' => [
                        'id' => $student->studentid,
                        'fullname' => $student->fullname,
                        'nickname' => $student->nickname,
                        'student_number' => $student->student_number,
                        'birthplace' => $student->birthplace,
                        'birthdate' => $student->birthdate?->format('Y-m-d'),
                        'gender' => $student->gender,
                        'religion' => $student->religion,
                        'nationality' => $student->nationality,
                        'address' => $student->address,
                        'photo' => $student->photo,
                        'class' => [
                            'name' => $student->class?->classname,
                            'teacher' => $student->class?->teacher?->employee?->fullname
                        ],
                        'school_year' => $student->schoolyear?->schoolyear
                    ],
                    'parent' => [
                        'name' => $student->parent?->name,
                        'status' => $student->parent?->status,
                        'contact' => $student->parent?->contact,
                        'occupation' => $student->parent?->occupation,
                        'education' => $student->parent?->education
                    ],
                    'physical' => [
                        'height_cm' => $student->physicalRecords?->height_cm,
                        'weight_kg' => $student->physicalRecords?->weight_kg,
                        'blood_type' => $student->physicalRecords?->blood_type,
                        'medical_history' => $student->physicalRecords?->medical_history
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve profile: ' . $e->getMessage()
            ], 500);
        }
    }
}
