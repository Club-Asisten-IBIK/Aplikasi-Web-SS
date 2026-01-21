<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class SchoolYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schoolYears = SchoolYear::all();
        return response()->json([
            'success' => true,
            'data' => $schoolYears,
            'message' => 'School years retrieved successfully'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'schoolyear' => 'required|string|max:20',
            'desc' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $schoolYear = SchoolYear::create($validated);

        return response()->json([
            'success' => true,
            'data' => $schoolYear,
            'message' => 'School year created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $schoolYear = SchoolYear::find($id);

        if (!$schoolYear) {
            return response()->json([
                'success' => false,
                'message' => 'School year not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $schoolYear,
            'message' => 'School year retrieved successfully'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $schoolYear = SchoolYear::find($id);

        if (!$schoolYear) {
            return response()->json([
                'success' => false,
                'message' => 'School year not found'
            ], 404);
        }

        $validated = $request->validate([
            'schoolyear' => 'required|string|max:20',
            'desc' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $schoolYear->update($validated);

        return response()->json([
            'success' => true,
            'data' => $schoolYear,
            'message' => 'School year updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $schoolYear = SchoolYear::find($id);

        if (!$schoolYear) {
            return response()->json([
                'success' => false,
                'message' => 'School year not found'
            ], 404);
        }

        $schoolYear->delete();

        return response()->json([
            'success' => true,
            'message' => 'School year deleted successfully'
        ]);
    }
}
