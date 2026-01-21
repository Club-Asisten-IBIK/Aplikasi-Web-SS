<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\ParentModel;
use App\Models\Physical_Records;
use App\Models\Educational_Histories;
use App\Models\LeavingRecords;
use App\Models\StudentGuardians;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        try {
            $students = Student::with([
                'parent',
                'physicalRecords',
                'educationalHistories',
                'leavingRecords',
                'guardians'
            ])->get();

            return response()->json([
                'status' => 'success',
                'data' => $students
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'sekolah_id' => 'required|exists:sekolah,id',
            'kelas_id' => 'required|exists:kelas,id',
            'nomor_induk' => 'required|string|max:50|unique:student,nomor_induk',
            'nama_lengkap' => 'required|string|max:50',
            'nama_panggilan' => 'nullable|string|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:40',
            'tanggal_lahir' => 'required|date',
            'wilayah' => 'nullable|in:Dalam Kota,Luar Kota',
            'kewarganegaraan' => 'required|in:WNI,WNA',
            'jumlah_saudara_kandung' => 'nullable|integer|min:0',
            'jumlah_saudara_tiri' => 'nullable|integer|min:0',
            'jumlah_saudara_angkat' => 'nullable|integer|min:0',
            'bahasa_rumah' => 'nullable|string|max:100',
            'alamat' => 'required|string',
            'status_tempat_tinggal' => 'nullable|in:Orang Tua,Wali,Asrama,Kost',
            'jarak_km' => 'nullable|numeric',
            'telepon' => 'nullable|string|max:16',
            'foto' => 'nullable|string|max:255',
            'status_siswa' => 'required|in:Calon,Aktif,Lulus',
            'tanggal_masuk' => 'required|date',
            'biaya_pendidikan' => 'nullable|numeric',
            'catatan' => 'nullable|string',

            // parent (opsional, satu baris)
            'orang_tua.nama_ayah' => 'nullable|string|max:50',
            'orang_tua.pendidikan_ayah' => 'nullable|in:SD,SMP,SMA,D3,S1,S2,S3',
            'orang_tua.pekerjaan_ayah' => 'nullable|string|max:100',
            'orang_tua.nama_ibu' => 'nullable|string|max:50',
            'orang_tua.pendidikan_ibu' => 'nullable|in:SD,SMP,SMA,D3,S1,S2,S3',
            'orang_tua.pekerjaan_ibu' => 'nullable|string|max:100',

            // physical record (opsional)
            'fisik.berat_badan' => 'nullable|numeric',
            'fisik.tinggi_badan' => 'nullable|numeric',
            'fisik.golongan_darah' => 'nullable|in:A,B,AB,O,Tidak Diketahui',
            'fisik.riwayat_penyakit' => 'nullable|string',

            // educational histories (array)
            'riwayat_pendidikan' => 'array',
            'riwayat_pendidikan.*.jenis_masuk' => 'required_with:riwayat_pendidikan|string|in:Baru,Pindahan',
            'riwayat_pendidikan.*.nama_instansi' => 'required_with:riwayat_pendidikan|string|max:100',
            'riwayat_pendidikan.*.alamat_instansi' => 'nullable|string',
            'riwayat_pendidikan.*.usia_saat_masuk' => 'nullable|string|max:50',
            'riwayat_pendidikan.*.tanggal_diterima' => 'nullable|date',
            'riwayat_pendidikan.*.kelompok_usia' => 'nullable|string|max:50',

            // leaving records (array)
            'catatan_keluar' => 'array',
            'catatan_keluar.*.jenis_keluar' => 'required_with:catatan_keluar|string|max:10',
            'catatan_keluar.*.nomor_surat' => 'nullable|string|max:100',
            'catatan_keluar.*.melanjutkan_ke' => 'nullable|string|max:150',
            'catatan_keluar.*.asal_kelompok' => 'nullable|string|max:50',
            'catatan_keluar.*.tujuan_instansi' => 'nullable|string|max:150',
            'catatan_keluar.*.kelompok_tujuan' => 'nullable|string|max:50',
            'catatan_keluar.*.tanggal_pindah' => 'nullable|date',
            'catatan_keluar.*.tanggal_keluar' => 'nullable|date',
            'catatan_keluar.*.alasan' => 'nullable|string',

            // guardians (array)
            'wali' => 'array',
            'wali.*.nama' => 'required_with:wali|string|max:50',
            'wali.*.hubungan_keluarga' => 'required_with:wali|string|max:50',
            'wali.*.pendidikan' => 'nullable|in:SD,SMP,SMA,D3,S1,S2,S3',
            'wali.*.pekerjaan' => 'nullable|string|max:100',
        ]);

        DB::beginTransaction();
        try {
            $studentData = $request->only([
                'sekolah_id',
                'kelas_id',
                'nomor_induk',
                'nama_lengkap',
                'nama_panggilan',
                'jenis_kelamin',
                'tempat_lahir',
                'tanggal_lahir',
                'wilayah',
                'kewarganegaraan',
                'jumlah_saudara_kandung',
                'jumlah_saudara_tiri',
                'jumlah_saudara_angkat',
                'bahasa_rumah',
                'alamat',
                'status_tempat_tinggal',
                'jarak_km',
                'telepon',
                'foto',
                'status_siswa',
                'tanggal_masuk',
                'biaya_pendidikan',
                'catatan',
            ]);

            $student = Student::create($studentData);

            // otomatis buat akun user dengan username & password = nomor_induk
            User::firstOrCreate(
                ['username' => $student->nomor_induk],
                [
                    'password' => Hash::make($student->nomor_induk),
                    'isactive' => true,
                ]
            );

            // data orang tua (satu baris)
            if ($request->filled('orang_tua.nama_ayah') || $request->filled('orang_tua.nama_ibu')) {
                ParentModel::create([
                    'siswa_id' => $student->id,
                    'nama_ayah' => data_get($request, 'orang_tua.nama_ayah'),
                    'pendidikan_ayah' => data_get($request, 'orang_tua.pendidikan_ayah'),
                    'pekerjaan_ayah' => data_get($request, 'orang_tua.pekerjaan_ayah'),
                    'nama_ibu' => data_get($request, 'orang_tua.nama_ibu'),
                    'pendidikan_ibu' => data_get($request, 'orang_tua.pendidikan_ibu'),
                    'pekerjaan_ibu' => data_get($request, 'orang_tua.pekerjaan_ibu'),
                ]);
            }

            // catatan fisik
            if ($request->has('fisik')) {
                $fisik = $request->input('fisik');
                if (!empty($fisik)) {
                    Physical_Records::create([
                        'siswa_id' => $student->id,
                        'berat_badan' => $fisik['berat_badan'] ?? null,
                        'tinggi_badan' => $fisik['tinggi_badan'] ?? null,
                        'golongan_darah' => $fisik['golongan_darah'] ?? null,
                        'riwayat_penyakit' => $fisik['riwayat_penyakit'] ?? null,
                    ]);
                }
            }

            // riwayat pendidikan (banyak)
            if ($request->has('riwayat_pendidikan') && is_array($request->riwayat_pendidikan)) {
                foreach ($request->riwayat_pendidikan as $row) {
                    Educational_Histories::create([
                        'siswa_id' => $student->id,
                        'jenis_masuk' => $row['jenis_masuk'] ?? 'Baru',
                        'nama_instansi' => $row['nama_instansi'] ?? '',
                        'alamat_instansi' => $row['alamat_instansi'] ?? null,
                        'usia_saat_masuk' => $row['usia_saat_masuk'] ?? null,
                        'tanggal_diterima' => $row['tanggal_diterima'] ?? null,
                        'kelompok_usia' => $row['kelompok_usia'] ?? null,
                    ]);
                }
            }

            // catatan keluar (banyak)
            if ($request->has('catatan_keluar') && is_array($request->catatan_keluar)) {
                foreach ($request->catatan_keluar as $row) {
                    LeavingRecords::create([
                        'siswa_id' => $student->id,
                        'jenis_keluar' => $row['jenis_keluar'] ?? '',
                        'nomor_surat' => $row['nomor_surat'] ?? null,
                        'melanjutkan_ke' => $row['melanjutkan_ke'] ?? null,
                        'asal_kelompok' => $row['asal_kelompok'] ?? null,
                        'tujuan_instansi' => $row['tujuan_instansi'] ?? null,
                        'kelompok_tujuan' => $row['kelompok_tujuan'] ?? null,
                        'tanggal_pindah' => $row['tanggal_pindah'] ?? null,
                        'tanggal_keluar' => $row['tanggal_keluar'] ?? null,
                        'alasan' => $row['alasan'] ?? null,
                    ]);
                }
            }

            // wali / guardian (banyak)
            if ($request->has('wali') && is_array($request->wali)) {
                foreach ($request->wali as $row) {
                    if (!empty($row['nama'])) {
                        StudentGuardians::create([
                            'siswa_id' => $student->id,
                            'nama' => $row['nama'],
                            'hubungan_keluarga' => $row['hubungan_keluarga'] ?? '',
                            'pendidikan' => $row['pendidikan'] ?? null,
                            'pekerjaan' => $row['pekerjaan'] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Student created successfully',
                'data' => $student
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $student = Student::with([
            'parent',
            'physicalRecords',
            'educationalHistories',
            'leavingRecords',
            'guardians'
        ])->findOrFail($id);

        return response()->json($student);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sekolah_id' => 'required|exists:sekolah,id',
            'kelas_id' => 'required|exists:kelas,id',
            'nomor_induk' => 'required|string|max:50|unique:student,nomor_induk,' . $id,
            'nama_lengkap' => 'required|string|max:50',
            'nama_panggilan' => 'nullable|string|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:40',
            'tanggal_lahir' => 'required|date',
            'wilayah' => 'nullable|in:Dalam Kota,Luar Kota',
            'kewarganegaraan' => 'required|in:WNI,WNA',
            'jumlah_saudara_kandung' => 'nullable|integer|min:0',
            'jumlah_saudara_tiri' => 'nullable|integer|min:0',
            'jumlah_saudara_angkat' => 'nullable|integer|min:0',
            'bahasa_rumah' => 'nullable|string|max:100',
            'alamat' => 'required|string',
            'status_tempat_tinggal' => 'nullable|in:Orang Tua,Wali,Asrama,Kost',
            'jarak_km' => 'nullable|numeric',
            'telepon' => 'nullable|string|max:16',
            'foto' => 'nullable|string|max:255',
            'status_siswa' => 'required|in:Calon,Aktif,Lulus',
            'tanggal_masuk' => 'required|date',
            'biaya_pendidikan' => 'nullable|numeric',
            'catatan' => 'nullable|string',

            'orang_tua.nama_ayah' => 'nullable|string|max:50',
            'orang_tua.pendidikan_ayah' => 'nullable|in:SD,SMP,SMA,D3,S1,S2,S3',
            'orang_tua.pekerjaan_ayah' => 'nullable|string|max:100',
            'orang_tua.nama_ibu' => 'nullable|string|max:50',
            'orang_tua.pendidikan_ibu' => 'nullable|in:SD,SMP,SMA,D3,S1,S2,S3',
            'orang_tua.pekerjaan_ibu' => 'nullable|string|max:100',

            'fisik.berat_badan' => 'nullable|numeric',
            'fisik.tinggi_badan' => 'nullable|numeric',
            'fisik.golongan_darah' => 'nullable|in:A,B,AB,O,Tidak Diketahui',
            'fisik.riwayat_penyakit' => 'nullable|string',

            'riwayat_pendidikan' => 'array',
            'riwayat_pendidikan.*.jenis_masuk' => 'required_with:riwayat_pendidikan|string|in:Baru,Pindahan',
            'riwayat_pendidikan.*.nama_instansi' => 'required_with:riwayat_pendidikan|string|max:100',
            'riwayat_pendidikan.*.alamat_instansi' => 'nullable|string',
            'riwayat_pendidikan.*.usia_saat_masuk' => 'nullable|string|max:50',
            'riwayat_pendidikan.*.tanggal_diterima' => 'nullable|date',
            'riwayat_pendidikan.*.kelompok_usia' => 'nullable|string|max:50',

            'catatan_keluar' => 'array',
            'catatan_keluar.*.jenis_keluar' => 'required_with:catatan_keluar|string|max:10',
            'catatan_keluar.*.nomor_surat' => 'nullable|string|max:100',
            'catatan_keluar.*.melanjutkan_ke' => 'nullable|string|max:150',
            'catatan_keluar.*.asal_kelompok' => 'nullable|string|max:50',
            'catatan_keluar.*.tujuan_instansi' => 'nullable|string|max:150',
            'catatan_keluar.*.kelompok_tujuan' => 'nullable|string|max:50',
            'catatan_keluar.*.tanggal_pindah' => 'nullable|date',
            'catatan_keluar.*.tanggal_keluar' => 'nullable|date',
            'catatan_keluar.*.alasan' => 'nullable|string',

            'wali' => 'array',
            'wali.*.nama' => 'required_with:wali|string|max:50',
            'wali.*.hubungan_keluarga' => 'required_with:wali|string|max:50',
            'wali.*.pendidikan' => 'nullable|in:SD,SMP,SMA,D3,S1,S2,S3',
            'wali.*.pekerjaan' => 'nullable|string|max:100',
        ]);

        DB::beginTransaction();
        try {
            $student = Student::findOrFail($id);

            $studentData = $request->only([
                'sekolah_id',
                'kelas_id',
                'nomor_induk',
                'nama_lengkap',
                'nama_panggilan',
                'jenis_kelamin',
                'tempat_lahir',
                'tanggal_lahir',
                'wilayah',
                'kewarganegaraan',
                'jumlah_saudara_kandung',
                'jumlah_saudara_tiri',
                'jumlah_saudara_angkat',
                'bahasa_rumah',
                'alamat',
                'status_tempat_tinggal',
                'jarak_km',
                'telepon',
                'foto',
                'status_siswa',
                'tanggal_masuk',
                'biaya_pendidikan',
                'catatan',
            ]);

            $student->update($studentData);

            // orang tua: update atau create satu baris
            if ($request->has('orang_tua')) {
                $parentData = [
                    'nama_ayah' => data_get($request, 'orang_tua.nama_ayah'),
                    'pendidikan_ayah' => data_get($request, 'orang_tua.pendidikan_ayah'),
                    'pekerjaan_ayah' => data_get($request, 'orang_tua.pekerjaan_ayah'),
                    'nama_ibu' => data_get($request, 'orang_tua.nama_ibu'),
                    'pendidikan_ibu' => data_get($request, 'orang_tua.pendidikan_ibu'),
                    'pekerjaan_ibu' => data_get($request, 'orang_tua.pekerjaan_ibu'),
                ];
                $parent = ParentModel::where('siswa_id', $student->id)->first();
                if ($parent) {
                    $parent->update($parentData);
                } else {
                    ParentModel::create(array_merge($parentData, ['siswa_id' => $student->id]));
                }
            }

            // catatan fisik: update / create
            if ($request->has('fisik')) {
                $fisikReq = $request->input('fisik');
                $fisikData = [
                    'berat_badan' => $fisikReq['berat_badan'] ?? null,
                    'tinggi_badan' => $fisikReq['tinggi_badan'] ?? null,
                    'golongan_darah' => $fisikReq['golongan_darah'] ?? null,
                    'riwayat_penyakit' => $fisikReq['riwayat_penyakit'] ?? null,
                ];
                $fisik = Physical_Records::where('siswa_id', $student->id)->first();
                if ($fisik) {
                    $fisik->update($fisikData);
                } else {
                    Physical_Records::create(array_merge($fisikData, ['siswa_id' => $student->id]));
                }
            }

            // riwayat pendidikan: replace semua
            if ($request->has('riwayat_pendidikan') && is_array($request->riwayat_pendidikan)) {
                Educational_Histories::where('siswa_id', $student->id)->delete();
                foreach ($request->riwayat_pendidikan as $row) {
                    Educational_Histories::create([
                        'siswa_id' => $student->id,
                        'jenis_masuk' => $row['jenis_masuk'] ?? 'Baru',
                        'nama_instansi' => $row['nama_instansi'] ?? '',
                        'alamat_instansi' => $row['alamat_instansi'] ?? null,
                        'usia_saat_masuk' => $row['usia_saat_masuk'] ?? null,
                        'tanggal_diterima' => $row['tanggal_diterima'] ?? null,
                        'kelompok_usia' => $row['kelompok_usia'] ?? null,
                    ]);
                }
            }

            // catatan keluar: replace semua
            if ($request->has('catatan_keluar') && is_array($request->catatan_keluar)) {
                LeavingRecords::where('siswa_id', $student->id)->delete();
                foreach ($request->catatan_keluar as $row) {
                    LeavingRecords::create([
                        'siswa_id' => $student->id,
                        'jenis_keluar' => $row['jenis_keluar'] ?? '',
                        'nomor_surat' => $row['nomor_surat'] ?? null,
                        'melanjutkan_ke' => $row['melanjutkan_ke'] ?? null,
                        'asal_kelompok' => $row['asal_kelompok'] ?? null,
                        'tujuan_instansi' => $row['tujuan_instansi'] ?? null,
                        'kelompok_tujuan' => $row['kelompok_tujuan'] ?? null,
                        'tanggal_pindah' => $row['tanggal_pindah'] ?? null,
                        'tanggal_keluar' => $row['tanggal_keluar'] ?? null,
                        'alasan' => $row['alasan'] ?? null,
                    ]);
                }
            }

            // wali: replace semua
            if ($request->has('wali') && is_array($request->wali)) {
                StudentGuardians::where('siswa_id', $student->id)->delete();
                foreach ($request->wali as $row) {
                    if (!empty($row['nama'])) {
                        StudentGuardians::create([
                            'siswa_id' => $student->id,
                            'nama' => $row['nama'],
                            'hubungan_keluarga' => $row['hubungan_keluarga'] ?? '',
                            'pendidikan' => $row['pendidikan'] ?? null,
                            'pekerjaan' => $row['pekerjaan'] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();
            return response()->json($student);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            ParentModel::where('siswa_id', $id)->delete();
            Physical_Records::where('siswa_id', $id)->delete();
            Educational_Histories::where('siswa_id', $id)->delete();
            LeavingRecords::where('siswa_id', $id)->delete();
            StudentGuardians::where('siswa_id', $id)->delete();
            Student::findOrFail($id)->delete();
            DB::commit();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function storeParent(Request $request, $studentId)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'status' => 'required|in:father,mother,other',
            'contact' => 'required|string|max:16',
            'occupation' => 'nullable|string|max:50',
            'education' => 'required|in:SD,SMP,SMA,D1,D2,D3,S1,S2,S3,none'
        ]);

        try {
            DB::beginTransaction();

            $student = Student::findOrFail($studentId);
            $parent = ParentModel::create([
                'studentid' => $student->studentid,
                'name' => $request->name,
                'status' => $request->status,
                'contact' => $request->contact,
                'occupation' => $request->occupation,
                'education' => $request->education
            ]);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Parent added successfully',
                'data' => $parent
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateParent(Request $request, $parentId)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'status' => 'required|in:father,mother,other',
            'contact' => 'required|string|max:16',
            'occupation' => 'nullable|string|max:50',
            'education' => 'required|in:SD,SMP,SMA,D1,D2,D3,S1,S2,S3,none'
        ]);

        try {
            DB::beginTransaction();

            $parent = ParentModel::findOrFail($parentId);
            $parent->update($request->all());

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Parent updated successfully',
                'data' => $parent
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroyParent($parentId)
    {
        try {
            DB::beginTransaction();

            $parent = ParentModel::findOrFail($parentId);
            $parent->delete();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Parent deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
