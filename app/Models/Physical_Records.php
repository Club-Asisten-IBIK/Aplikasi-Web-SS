<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Physical_Records extends Model
{
    use HasFactory;
    protected $table = 'physical_records';
    protected $primaryKey = 'id';

    protected $fillable = [
        'siswa_id',
        'berat_badan',
        'tinggi_badan',
        'golongan_darah',
        'riwayat_penyakit',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'siswa_id', 'id');
    }
}
