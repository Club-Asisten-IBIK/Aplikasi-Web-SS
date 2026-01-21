<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeavingRecords extends Model
{
    use HasFactory;

    protected $table = 'leaving_records';
    protected $primaryKey = 'id';

    protected $fillable = [
        'siswa_id',
        'jenis_keluar',
        'nomor_surat',
        'melanjutkan_ke',
        'asal_kelompok',
        'tujuan_instansi',
        'kelompok_tujuan',
        'tanggal_pindah',
        'tanggal_keluar',
        'alasan',
    ];

    protected $casts = [
        'tanggal_pindah' => 'date',
        'tanggal_keluar' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'siswa_id', 'id');
    }
}
