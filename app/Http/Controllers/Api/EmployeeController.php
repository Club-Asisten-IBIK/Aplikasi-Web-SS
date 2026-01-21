<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('employeeid', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'data' => $employees
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:12|unique:employee,nip',
            'nik' => 'required|string|max:20|unique:employee,nik',
            'nama_lengkap' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'gelar_depan' => 'nullable|string|max:20',
            'gelar_belakang' => 'nullable|string|max:20',
            'pendidikan' => 'required|in:SD,SMP,SMA,D1,D2,D3,S1,S2,S3',
            'kontak' => 'required|string|max:16',
            'email' => 'required|email|max:16',
            'alamat' => 'required|string',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'foto' => 'nullable|string|max:255',
            'npwp' => 'required|string|max:50',
            'agama' => 'required|in:islam,kristen,katolik,hindu,budha,konghucu,lainnya',
            'status_perkawinan' => 'required|in:belum kawin,kawin,cerai hidup,cerai mati',
            'tanggal_masuk' => 'required|date',
        ]);

        $employee = Employee::create($request->all());

        // otomatis buat akun user dengan username & password = NIP
        User::firstOrCreate(
            ['username' => $employee->nip],
            [
                'password' => Hash::make($employee->nip),
                'isactive' => true,
            ]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Employee created successfully',
            'data' => $employee
        ], 201);
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $employee
        ]);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'nip' => ['required', 'string', 'max:12', Rule::unique('employee', 'nip')->ignore($id, 'employeeid')],
            'nik' => ['required', 'string', 'max:20', Rule::unique('employee', 'nik')->ignore($id, 'employeeid')],
            'nama_lengkap' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'gelar_depan' => 'nullable|string|max:20',
            'gelar_belakang' => 'nullable|string|max:20',
            'pendidikan' => 'required|in:SD,SMP,SMA,D1,D2,D3,S1,S2,S3',
            'kontak' => 'required|string|max:16',
            'email' => 'required|email|max:16',
            'alamat' => 'required|string',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'foto' => 'nullable|string|max:255',
            'npwp' => 'required|string|max:50',
            'agama' => 'required|in:islam,kristen,katolik,hindu,budha,konghucu,lainnya',
            'status_perkawinan' => 'required|in:belum kawin,kawin,cerai hidup,cerai mati',
            'tanggal_masuk' => 'required|date',
        ]);

        $employee->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Employee updated successfully',
            'data' => $employee
        ]);
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Employee deleted successfully'
        ]);
    }
}
