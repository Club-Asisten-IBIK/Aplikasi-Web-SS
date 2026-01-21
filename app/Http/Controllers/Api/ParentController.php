<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ParentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParentController extends Controller
{
    public function index()
    {
        try {
            $parents = ParentModel::with('student')->get();
            return response()->json([
                'status' => 'success',
                'data' => $parents
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch parents data'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'studentid' => 'required|exists:student,studentid',
            'name' => 'required|string|max:100',
            'status' => 'nullable|string',
            'contact' => 'nullable|string',
            'occupation' => 'nullable|string',
            'education' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        try {
            $parent = ParentModel::create($request->all());
            return response()->json([
                'status' => 'success',
                'data' => $parent
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create parent'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $parent = ParentModel::with('student')->findOrFail($id);
            return response()->json([
                'status' => 'success',
                'data' => $parent
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Parent not found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'status' => 'nullable|string',
            'contact' => 'nullable|string',
            'occupation' => 'nullable|string',
            'education' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        try {
            $parent = ParentModel::findOrFail($id);
            $parent->update($request->all());
            return response()->json([
                'status' => 'success',
                'data' => $parent
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update parent'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $parent = ParentModel::findOrFail($id);
            $parent->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Parent deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete parent'
            ], 500);
        }
    }
}
