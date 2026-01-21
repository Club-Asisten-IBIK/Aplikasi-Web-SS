<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $data = Kelas::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:100',
            'tingkat' => 'nullable|string|max:50',
            'kapasitas' => 'nullable|integer',
            'isactive' => 'boolean',
        ]);

        $kelas = Kelas::create($validated);

        return response()->json($kelas, 201);
    }

    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);
        return response()->json($kelas);
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $validated = $request->validate([
            'nama_kelas' => 'sometimes|required|string|max:100',
            'tingkat' => 'nullable|string|max:50',
            'kapasitas' => 'nullable|integer',
            'isactive' => 'boolean',
        ]);

        $kelas->update($validated);

        return response()->json($kelas);
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return response()->json(null, 204);
    }
}
