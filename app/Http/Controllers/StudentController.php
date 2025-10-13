<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ParentModel;
use App\Models\ClassModel;
use App\Models\Educational_Histories;
use App\Models\Physical_Records;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['class.guardian', 'parent', 'schoolyear'])->get();
        $schoolyears = SchoolYear::all();
        return view('student-management.student', compact('students', 'schoolyears'));
    }

    public function create()
    {
        $classes = ClassModel::with('guardian')->get();
        $schoolyears = SchoolYear::all();
        return view('student.create', compact('classes', 'schoolyears'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schoolyearid' => 'required|integer',
            'classid' => 'required|integer',
            'student_number' => 'required|string|max:20|unique:student,student_number',
            'fullname' => 'required|string|max:50',
            'nickname' => 'nullable|string|max:50',
            'birthplace' => 'nullable|string|max:50',
            'birthdate' => 'nullable|date',
            'gender' => 'required|string',
            'religion' => 'nullable|string',
            'nationality' => 'nullable|string',
            'siblings_full' => 'nullable|integer',
            'siblings_step' => 'nullable|integer',
            'siblings_adopted' => 'nullable|integer',
            'home_language' => 'nullable|string|max:100',
            'address' => 'required|string',
            'living_with' => 'nullable|string',
            'distance_km' => 'nullable|numeric',
            'photo' => 'nullable|string',
            'status' => 'required|string',
            'datejoin' => 'required|date',
            'studentfeeamount' => 'required|numeric',
            'contract' => 'nullable|string|max:100',
            // Parent
            'parent_name' => 'nullable|string|max:50',
            'parent_status' => 'nullable|string',
            'parent_contact' => 'nullable|string|max:16',
            'parent_occupation' => 'nullable|string|max:50',
            'parent_education' => 'nullable|string',
            // Validasi untuk physical records
            'height_cm' => 'required|numeric|min:0',
            'weight_kg' => 'required|numeric|min:0',
            'blood_type' => 'required|in:A,B,AB,O',
            'medical_history' => 'nullable|string',

        ]);

        $student = Student::create($request->only([
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
            'contract',
        ]));

        // Jika parent diisi, simpan ke tabel parent
        if ($request->filled('parent_name')) {
            ParentModel::create([
                'studentid' => $student->studentid,
                'name' => $request->parent_name,
                'status' => $request->parent_status,
                'contact' => $request->parent_contact,
                'occupation' => $request->parent_occupation,
                'education' => $request->parent_education,
            ]);
        }
        // Jika parent tidak diisi, simpan ke tabel student_guardians
        elseif ($request->filled('guardian_name')) {
            \App\Models\StudentGuardians::create([
                'studentid' => $student->studentid,
                'name' => $request->guardian_name,
                'family_relation' => $request->family_relation,
                'education' => $request->guardian_education,
                'occupation' => $request->guardian_occupation,
            ]);

            Physical_Records::create([
                'studentid' => $student->studentid,
                'height_cm' => $request->height_cm,
                'weight_kg' => $request->weight_kg,
                'blood_type' => $request->blood_type,
                'medical_history' => $request->medical_history,
            ]);
        }
        // Jika siswa pindahan, simpan educational histories
        if ($request->filled('institution_name')) {
            Educational_Histories::create([
                'studentid' => $student->studentid,
                'institution_name' => $request->institution_name,
                'institution_address' => $request->institution_address,
                'from_age_group' => $request->from_age_group,
                'admitted_date' => $request->admitted_date,
                'admitted_age_group' => $request->admitted_age_group,
            ]);
        }

        return redirect()->route('student.index')->with('added', true);
    }

    public function edit($id)
    {
        $student = Student::with('parent', 'physicalRecords')->findOrFail($id);
        $classes = ClassModel::with('guardian')->get();
        $schoolyears = SchoolYear::all();
        return view('student.edit', compact('student', 'classes', 'schoolyears'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'schoolyearid' => 'required|integer',
            'classid' => 'required|integer',
            'student_number' => 'required|string|max:20|unique:student,student_number,' . $id . ',studentid',
            'fullname' => 'required|string|max:50',
            'nickname' => 'nullable|string|max:50',
            'birthplace' => 'nullable|string|max:50',
            'birthdate' => 'nullable|date',
            'gender' => 'required|string',
            'religion' => 'nullable|string',
            'nationality' => 'nullable|string',
            'siblings_full' => 'nullable|integer',
            'siblings_step' => 'nullable|integer',
            'siblings_adopted' => 'nullable|integer',
            'home_language' => 'nullable|string|max:100',
            'address' => 'required|string',
            'living_with' => 'nullable|string',
            'distance_km' => 'nullable|numeric',
            'photo' => 'nullable|string',
            'status' => 'required|string',
            'datejoin' => 'required|date',
            'studentfeeamount' => 'required|numeric',
            'contract' => 'nullable|string|max:100',
            // Parent
            'parent_name' => 'nullable|string|max:50',
            'parent_status' => 'nullable|string',
            'parent_contact' => 'nullable|string|max:16',
            'parent_occupation' => 'nullable|string|max:50',
            'parent_education' => 'nullable|string',
            // Validasi untuk physical records
            'height_cm' => 'required|numeric|min:0',
            'weight_kg' => 'required|numeric|min:0',
            'blood_type' => 'required|in:A,B,AB,O',
            'medical_history' => 'nullable|string',
            // Validasi untuk student_guardians
            'guardian_name' => 'nullable|string|max:100',
            'family_relation' => 'nullable|in:father,mother,guardian',
            'guardian_education' => 'nullable|in:SD,SMP,SMA,D1,D2,D3,S1,S2,S3,none',
            'guardian_occupation' => 'nullable|string|max:100',
            // Validasi untuk educational histories
            'institution_name' => 'nullable|string|max:100',
            'institution_address' => 'nullable|string',
            'from_age_group' => 'nullable|string|max:50',
            'admitted_date' => 'nullable|date',
            'admitted_age_group' => 'nullable|string|max:50',



        ]);

        $student = Student::findOrFail($id);
        $student->update($request->only([
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
            'contract',
        ]));

        $parent = ParentModel::where('studentid', $id)->first();
        $guardian = \App\Models\StudentGuardians::where('studentid', $id)->first();

        // Jika parent diisi, perbarui atau buat baru
        if ($request->filled('parent_name')) {
            if ($parent) {
                $parent->update([
                    'name' => $request->parent_name,
                    'status' => $request->parent_status,
                    'contact' => $request->parent_contact,
                    'occupation' => $request->parent_occupation,
                    'education' => $request->parent_education,
                ]);
            } else {
                ParentModel::create([
                    'studentid' => $id,
                    'name' => $request->parent_name,
                    'status' => $request->parent_status,
                    'contact' => $request->parent_contact,
                    'occupation' => $request->parent_occupation,
                    'education' => $request->parent_education,
                ]);
            }
            // Hapus data guardian jika parent diisi
            if ($guardian) {
                $guardian->delete();
            }
        }
        // Jika parent tidak diisi, perbarui atau buat data guardian
        elseif ($request->filled('guardian_name')) {
            if ($guardian) {
                $guardian->update([
                    'name' => $request->guardian_name,
                    'family_relation' => $request->family_relation,
                    'education' => $request->guardian_education,
                    'occupation' => $request->guardian_occupation,
                ]);
            } else {
                \App\Models\StudentGuardians::create([
                    'studentid' => $id,
                    'name' => $request->guardian_name,
                    'family_relation' => $request->family_relation,
                    'education' => $request->guardian_education,
                    'occupation' => $request->guardian_occupation,
                ]);
            }
            // Hapus data parent jika guardian diisi
            if ($parent) {
                $parent->delete();
            }
        }

        $physicalRecord = Physical_Records::where('studentid', $id)->first();
        if ($physicalRecord) {
            $physicalRecord->update([
                'height_cm' => $request->height_cm,
                'weight_kg' => $request->weight_kg,
                'blood_type' => $request->blood_type,
                'medical_history' => $request->medical_history,
            ]);
        } else {
            Physical_Records::create([
                'studentid' => $id,
                'height_cm' => $request->height_cm,
                'weight_kg' => $request->weight_kg,
                'blood_type' => $request->blood_type,
                'medical_history' => $request->medical_history,
            ]);
        }

        $educationalHistory = Educational_Histories::where('studentid', $id)->first();

        // Jika siswa pindahan, perbarui atau buat educational histories
        if ($request->filled('institution_name')) {
            if ($educationalHistory) {
                $educationalHistory->update([
                    'institution_name' => $request->institution_name,
                    'institution_address' => $request->institution_address,
                    'from_age_group' => $request->from_age_group,
                    'admitted_date' => $request->admitted_date,
                    'admitted_age_group' => $request->admitted_age_group,
                ]);
            } else {
                Educational_Histories::create([
                    'studentid' => $id,
                    'institution_name' => $request->institution_name,
                    'institution_address' => $request->institution_address,
                    'from_age_group' => $request->from_age_group,
                    'admitted_date' => $request->admitted_date,
                    'admitted_age_group' => $request->admitted_age_group,
                ]);
            }
        }

        return redirect()->route('student.index')->with('edited', true);
    }


    public function destroy($id)
    {
        ParentModel::where('studentid', $id)->delete();
        Student::where('studentid', $id)->delete();
        return redirect()->route('student.index')->with('deleted', true);
    }
}
