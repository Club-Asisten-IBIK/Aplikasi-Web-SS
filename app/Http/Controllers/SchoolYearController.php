<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolYear;

class SchoolYearController extends Controller
{
    public function index()
    {
        $schoolyears = SchoolYear::all();
        return view('student-management.school-year', compact('schoolyears'));
    }

    public function create()
    {
        return view('student-management.school-year-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'schoolyear' => 'required|string|max:20',
            'desc' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        SchoolYear::create($request->only(['schoolyear', 'desc', 'is_active']));

        return redirect()->route('school-year.index')->with('success', 'Tahun ajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $schoolyear = SchoolYear::findOrFail($id);
        return view('student-management.school-year-edit', compact('schoolyear'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'schoolyear' => 'required|string|max:20',
            'desc' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $schoolyear = SchoolYear::findOrFail($id);
        $schoolyear->update($request->only(['schoolyear', 'desc', 'is_active']));

        return redirect()->route('school-year.index')->with('success', 'Tahun ajaran berhasil diupdate.');
    }

    public function destroy($id)
    {
        $schoolyear = SchoolYear::findOrFail($id);
        $schoolyear->delete();

        return redirect()->route('school-year.index')->with('success', 'Tahun ajaran berhasil dihapus.');
    }
}
