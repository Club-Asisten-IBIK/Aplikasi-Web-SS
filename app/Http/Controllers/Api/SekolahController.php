<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function index()
    {
        $data = Sekolah::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'isactive' => 'boolean',
        ]);

        $sekolah = Sekolah::create($validated);

        return response()->json($sekolah, 201);
    }

    public function show($id)
    {
        $sekolah = Sekolah::findOrFail($id);
        return response()->json($sekolah);
    }

    public function update(Request $request, $id)
    {
        $sekolah = Sekolah::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:150',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'isactive' => 'boolean',
        ]);

        $sekolah->update($validated);

        return response()->json($sekolah);
    }

    public function destroy($id)
    {
        $sekolah = Sekolah::findOrFail($id);
        $sekolah->delete();

        return response()->json(null, 204);
    }
}
