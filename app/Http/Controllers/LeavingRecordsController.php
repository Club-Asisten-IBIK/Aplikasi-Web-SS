<?php


namespace App\Http\Controllers;

use App\Models\LeavingRecords;
use App\Models\Student;
use Illuminate\Http\Request;

class LeavingRecordsController extends Controller
{
    public function index()
    {
        $leavingRecords = LeavingRecords::with('student')->get();
        return view('leaving-records.index', compact('leavingRecords'));
    }

    public function create()
    {
        $students = Student::where('status', '!=', 'graduated')->get();
        return view('leaving-records.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'studentid' => 'required|exists:student,studentid',
            'entry_type' => 'required|string|max:10',
            'letter_type' => 'required|string|max:100',
            'continues_to_institution' => 'required|string|max:150',
            'from_age_group' => 'required|string|max:50',
            'destination_institution' => 'required|string|max:50',
            'destination_age_group_level' => 'required|string|max:50',
            'transfer_date' => 'required|date',
            'exit_date' => 'required|date',
            'reason' => 'nullable|string'
        ]);

        $leavingRecord = LeavingRecords::create($request->all());

        // Update student status to graduated/inactive
        $student = Student::find($request->studentid);
        $student->update(['status' => 'graduated']);

        return redirect()->route('leaving-records.index')
            ->with('success', 'Leaving record created successfully');
    }

    public function show($id)
    {
        $leavingRecord = LeavingRecords::with('student')->findOrFail($id);
        return view('leaving-records.show', compact('leavingRecord'));
    }

    public function edit($id)
    {
        $leavingRecord = LeavingRecords::findOrFail($id);
        $students = Student::all();
        return view('leaving-records.edit', compact('leavingRecord', 'students'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'studentid' => 'required|exists:student,studentid',
            'entry_type' => 'required|string|max:10',
            'letter_type' => 'required|string|max:100',
            'continues_to_institution' => 'required|string|max:150',
            'from_age_group' => 'required|string|max:50',
            'destination_institution' => 'required|string|max:50',
            'destination_age_group_level' => 'required|string|max:50',
            'transfer_date' => 'required|date',
            'exit_date' => 'required|date',
            'reason' => 'nullable|string'
        ]);

        $leavingRecord = LeavingRecords::findOrFail($id);
        $leavingRecord->update($request->all());

        return redirect()->route('leaving-records.index')
            ->with('success', 'Leaving record updated successfully');
    }

    public function destroy($id)
    {
        $leavingRecord = LeavingRecords::findOrFail($id);

        // Optionally revert student status if needed
        $student = Student::find($leavingRecord->studentid);
        $student->update(['status' => 'student']);

        $leavingRecord->delete();

        return redirect()->route('leaving-records.index')
            ->with('success', 'Leaving record deleted successfully');
    }
}
