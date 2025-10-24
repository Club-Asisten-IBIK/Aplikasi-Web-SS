<?php

namespace App\Http\Controllers;

use App\Models\Educational_Histories;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class EducationalHistoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $histories = Educational_Histories::with('student')->get();
            return view('student-management.educational.index', compact('histories'));
        } catch (QueryException $e) {
            return back()->with('error', 'Gagal mengambil data riwayat pendidikan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $students = Student::select('studentid', 'student_number', 'fullname')->get();
            return view('student-management.educational.create', compact('students'));
        } catch (QueryException $e) {
            return back()->with('error', 'Gagal memuat form: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'studentid' => 'required|exists:student,studentid',
            'institution_name' => 'required|string|max:100',
            'institution_address' => 'required|string',
            'from_age_group' => 'required|string|max:50',
            'admitted_date' => 'required|date',
            'admitted_age_group' => 'required|string|max:50'
        ]);

        try {
            DB::beginTransaction();

            Educational_Histories::create($request->all());

            DB::commit();
            return redirect()->route('educational.index')
                ->with('success', 'Riwayat pendidikan berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $history = Educational_Histories::with('student')->findOrFail($id);
            return view('student-management.educational.show', compact('history'));
        } catch (QueryException $e) {
            return back()->with('error', 'Gagal menampilkan data: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $history = Educational_Histories::findOrFail($id);
            $students = Student::select('studentid', 'student_number', 'fullname')->get();
            return view('student-management.educational.edit', compact('history', 'students'));
        } catch (QueryException $e) {
            return back()->with('error', 'Gagal memuat data: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'studentid' => 'required|exists:student,studentid',
            'institution_name' => 'required|string|max:100',
            'institution_address' => 'required|string',
            'from_age_group' => 'required|string|max:50',
            'admitted_date' => 'required|date',
            'admitted_age_group' => 'required|string|max:50'
        ]);

        try {
            DB::beginTransaction();

            $history = Educational_Histories::findOrFail($id);
            $history->update($request->all());

            DB::commit();
            return redirect()->route('educational.index')
                ->with('success', 'Riwayat pendidikan berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $history = Educational_Histories::findOrFail($id);
            $history->delete();

            DB::commit();
            return redirect()->route('educational.index')
                ->with('success', 'Riwayat pendidikan berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
