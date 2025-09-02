<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComponentSalary;

class ComponentSalaryController extends Controller
{
    // Tampilkan semua komponen gaji
    public function index()
    {
        $components = ComponentSalary::all();
        return view('finance-management.component-salary', compact('components'));
    }

    // Tampilkan form tambah komponen gaji
    public function create()
    {
        return view('finance-management.component-salary-create');
    }

    // Simpan komponen gaji baru
    public function store(Request $request)
    {
        $request->validate([
            'componentname' => 'required|string|max:255'
        ]);

        ComponentSalary::create([
            'componentname' => $request->componentname
        ]);

        return redirect()->route('component-salary.index')->with('success', 'Komponen gaji berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $component = ComponentSalary::findOrFail($id);
        return view('finance-management.component-salary-edit', compact('component'));
    }

    // Update komponen gaji
    public function update(Request $request, $id)
    {
        $request->validate([
            'componentname' => 'required|string|max:255'
        ]);

        $component = ComponentSalary::findOrFail($id);
        $component->update([
            'componentname' => $request->componentname
        ]);

        return redirect()->route('component-salary.index')->with('success', 'Komponen gaji berhasil diupdate.');
    }

    // Hapus komponen gaji
    public function destroy($id)
    {
        $component = ComponentSalary::findOrFail($id);
        $component->delete();

        return redirect()->route('component-salary.index')->with('success', 'Komponen gaji berhasil dihapus.');
    }
}
