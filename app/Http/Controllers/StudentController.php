<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ParentModel;
use App\Models\Physical_Records;
use App\Models\SchoolYear;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    // LIST STUDENTS
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

            return view('student-management.students.student', compact('students'));
        } catch (QueryException $e) {
            return back()->with('error', 'Gagal mengambil data siswa: ' . $e->getMessage());
        }
    }

    // SHOW CREATE FORM
    public function create()
    {
        try {
            $schoolyears = SchoolYear::where('is_active', true)->get();
            $classes = ClassModel::with('teacher.employee')->where('isactive', true)->get();
            return view('student-management.students.student-create', compact('schoolyears', 'classes'));
        } catch (QueryException $e) {
            return back()->with('error', 'Gagal memuat formulir: ' . $e->getMessage());
        }
    }

    // STORE STUDENT (+ optional parents and physical record)
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
            // photo can be uploaded file; controller will save file and store path as string
            'photo' => 'nullable|file|image|max:2048',
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
                'address',
                'status',
                'datejoin',
                'studentfeeamount',
                'contract'
            ]);

            // handle photo upload -> store path string in DB
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                    . '-' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('students', $filename, 'public'); // saved to storage/app/public/students
                $input['photo'] = $path; // string path stored in DB
            } elseif ($request->filled('photo')) {
                // if user sends a string path/url instead of file
                $input['photo'] = $request->input('photo');
            }

            $student = Student::create($input);

            // optional parents (array of parents)
            if ($request->has('parents') && is_array($request->parents)) {
                foreach ($request->parents as $p) {
                    $pdata = array_merge($p, ['studentid' => $student->studentid]);
                    // minimal validation for each parent entry
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
            return redirect()->route('student.index')->with('added', true);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    // SHOW EDIT FORM
    public function edit($id)
    {
        try {
            $student = Student::with(['parent', 'physicalRecords'])->findOrFail($id);
            $schoolyears = SchoolYear::where('is_active', true)->get();
            $classes = ClassModel::with('teacher.employee')->where('isactive', true)->get();
            return view('student-management.students.student-edit', compact('student', 'schoolyears', 'classes'));
        } catch (QueryException $e) {
            return back()->with('error', 'Gagal memuat data: ' . $e->getMessage());
        }
    }

    // UPDATE STUDENT (+ replace parents and update/create physical)
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
            'address' => 'required|string',
            'status' => 'required|in:prostudent,student,graduated',
            'photo' => 'nullable|file|image|max:2048',
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
                'address',
                'status',
                'datejoin',
                'studentfeeamount',
                'contract'
            ]);

            // handle photo upload or string
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                    . '-' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('students', $filename, 'public');
                $input['photo'] = $path;
            } elseif ($request->filled('photo')) {
                $input['photo'] = $request->input('photo');
            }

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
            return redirect()->route('student.index')->with('edited', true);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    // DELETE STUDENT + related parents & physical records
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            ParentModel::where('studentid', $id)->delete();
            Physical_Records::where('studentid', $id)->delete();
            Student::findOrFail($id)->delete();
            DB::commit();
            return redirect()->route('student.index')->with('deleted', true);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menghapus siswa: ' . $e->getMessage());
        }
    }

    // Additional endpoints to manage parents individually (optional)
    public function storeParent(Request $request)
    {
        $request->validate([
            'studentid' => 'required|exists:student,studentid',
            'name' => 'required|string|max:100',
        ]);

        try {
            ParentModel::create($request->only(['studentid', 'name', 'status', 'contact', 'occupation', 'education']));
            return back()->with('added', true);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan orang tua: ' . $e->getMessage());
        }
    }

    public function updateParent(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        try {
            $parent = ParentModel::findOrFail($id);
            $parent->update($request->only(['name', 'status', 'contact', 'occupation', 'education']));
            return back()->with('edited', true);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui orang tua: ' . $e->getMessage());
        }
    }

    public function destroyParent($id)
    {
        try {
            ParentModel::findOrFail($id)->delete();
            return back()->with('deleted', true);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus orang tua: ' . $e->getMessage());
        }
    }

    // Additional endpoints to manage physical records individually (optional)
    public function storePhysical(Request $request)
    {
        $request->validate([
            'studentid' => 'required|exists:student,studentid',
            'height_cm' => 'nullable|numeric',
            'weight_kg' => 'nullable|numeric',
        ]);

        try {
            Physical_Records::create($request->only(['studentid', 'height_cm', 'weight_kg', 'blood_type', 'medical_history']));
            return back()->with('added', true);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan record fisik: ' . $e->getMessage());
        }
    }

    public function updatePhysical(Request $request, $id)
    {
        $request->validate([
            'height_cm' => 'nullable|numeric',
            'weight_kg' => 'nullable|numeric',
        ]);

        try {
            $record = Physical_Records::findOrFail($id);
            $record->update($request->only(['height_cm', 'weight_kg', 'blood_type', 'medical_history']));
            return back()->with('edited', true);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui record fisik: ' . $e->getMessage());
        }
    }

    public function destroyPhysical($id)
    {
        try {
            Physical_Records::findOrFail($id)->delete();
            return back()->with('deleted', true);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus record fisik: ' . $e->getMessage());
        }
    }
}
