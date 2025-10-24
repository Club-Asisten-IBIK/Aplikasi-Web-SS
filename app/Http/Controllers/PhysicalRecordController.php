<?php

namespace App\Http\Controllers;

use App\Models\Physical_Records;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class PhysicalRecordController extends Controller
{
    public function index()
    {
        try {
            $physicalRecords = Physical_Records::with('student')->get();
            return view('student-management.physical.index', compact('physicalRecords'));
        } catch (QueryException $e) {
            return back()->with('error', 'Gagal mengambil data rekam fisik: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $students = Student::select('studentid', 'student_number', 'fullname')->get();
            return view('student-management.physical.create', compact('students'));
        } catch (QueryException $e) {
            return back()->with('error', 'Gagal memuat form: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'studentid' => 'required|exists:student,studentid',
            'height_cm' => 'required|numeric|between:0,999.99',
            'weight_kg' => 'required|numeric|between:0,999.99',
            'blood_type' => 'required|in:A,B,AB,O',
            'medical_history' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            Physical_Records::create($request->all());

            DB::commit();
            return redirect()->route('physical.index')
                ->with('success', 'Data rekam fisik berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $physicalRecord = Physical_Records::with('student')->findOrFail($id);
            return view('student-management.physical.show', compact('physicalRecord'));
        } catch (QueryException $e) {
            return back()->with('error', 'Gagal menampilkan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $physicalRecord = Physical_Records::findOrFail($id);
            $students = Student::select('studentid', 'student_number', 'fullname')->get();
            return view(
                'student-management.physical.edit',
                compact('physicalRecord', 'students')
            );
        } catch (QueryException $e) {
            return back()->with('error', 'Gagal memuat data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'studentid' => 'required|exists:student,studentid',
            'height_cm' => 'required|numeric|between:0,999.99',
            'weight_kg' => 'required|numeric|between:0,999.99',
            'blood_type' => 'required|in:A,B,AB,O',
            'medical_history' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            $physicalRecord = Physical_Records::findOrFail($id);
            $physicalRecord->update($request->all());

            DB::commit();
            return redirect()->route('physical.index')
                ->with('success', 'Data rekam fisik berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $physicalRecord = Physical_Records::findOrFail($id);
            $physicalRecord->delete();

            DB::commit();
            return redirect()->route('physical.index')
                ->with('success', 'Data rekam fisik berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
