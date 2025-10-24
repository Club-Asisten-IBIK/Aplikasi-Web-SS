<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Employee;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('teachers.employee')->get();
        return view('student-management.subject.index', compact('subjects'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('student-management.subject.create', compact('employees'));
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
            // Create subject
            $subject = Subject::create($request->only([
                'code',
                'name',
                'gradelevel',
                'is_active'
            ]));

            // Create teacher records
            foreach ($request->employee_ids as $employeeId) {
                Teacher::create([
                    'employee_id' => $employeeId,
                    'subject_id' => $subject->subjectid
                ]);
            }

            DB::commit();
            return redirect()->route('subject.index')->with('added', true);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function edit($id)
    {
        $subject = Subject::with('teachers.employee')->findOrFail($id);
        $employees = Employee::all();
        return view('student-management.subject.edit', compact('subject', 'employees'));
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

            // Update subject details
            $subject->update($request->only([
                'code',
                'name',
                'gradelevel',
                'is_active'
            ]));

            // Update teacher assignments
            Teacher::where('subject_id', $subject->subjectid)->delete();
            foreach ($request->employee_ids as $employeeId) {
                Teacher::create([
                    'employee_id' => $employeeId,
                    'subject_id' => $subject->subjectid
                ]);
            }

            DB::commit();
            return redirect()->route('subject.index')->with('edited', true);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    public function destroy($id)
    {
        Subject::where('subjectid', $id)->delete();
        return redirect()->route('subject.index')->with('deleted', true);
    }
}
