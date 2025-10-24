<?php

namespace App\Http\Controllers;

use App\Models\ParentModel;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ParentController extends Controller
{
    public function index()
    {
        try {
            $parents = ParentModel::with('student')->get();
            return view('student-management.parents.index', compact('parents'));
        } catch (QueryException $e) {
            return back()->with('error', 'Gagal mengambil data orang tua: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $students = Student::select('studentid', 'student_number', 'fullname')->get();
            return view('student-management.parents.create', compact('students'));
        } catch (QueryException $e) {
            return back()->with('error', 'Gagal memuat form: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'studentid' => 'required|exists:student,studentid',
            'name' => 'required|string|max:50',
            'status' => 'required|in:father,mother,other',
            'contact' => 'required|string|max:16',
            'occupation' => 'nullable|string|max:50',
            'education' => 'required|in:SD,SMP,SMA,D1,D2,D3,S1,S2,S3,none'
        ]);

        try {
            DB::beginTransaction();

            ParentModel::create($request->all());

            DB::commit();
            return redirect()->route('parent.index')->with('success', 'Data orang tua berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $parent = ParentModel::findOrFail($id);
            $students = Student::select('studentid', 'student_number', 'fullname')->get();
            return view('student-management.parents.edit', compact('parent', 'students'));
        } catch (QueryException $e) {
            return back()->with('error', 'Gagal memuat data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'studentid' => 'required|exists:student,studentid',
            'name' => 'required|string|max:50',
            'status' => 'required|in:father,mother,other',
            'contact' => 'required|string|max:16',
            'occupation' => 'nullable|string|max:50',
            'education' => 'required|in:SD,SMP,SMA,D1,D2,D3,S1,S2,S3,none'
        ]);

        try {
            DB::beginTransaction();

            $parent = ParentModel::findOrFail($id);
            $parent->update($request->all());

            DB::commit();
            return redirect()->route('parent.index')
                ->with('success', 'Data orang tua berhasil diperbarui');
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

            $parent = ParentModel::findOrFail($id);
            $parent->delete();

            DB::commit();
            return redirect()->route('parent.index')
                ->with('success', 'Data orang tua berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
