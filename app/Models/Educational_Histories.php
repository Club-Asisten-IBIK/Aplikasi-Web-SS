<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educational_Histories extends Model
{
    use HasFactory;

    protected $table = 'educational__histories';
    protected $primaryKey = 'id';

    protected $fillable = [
        'siswa_id',
        'jenis_masuk',
        'nama_instansi',
        'alamat_instansi',
        'usia_saat_masuk',
        'tanggal_diterima',
        'kelompok_usia',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'siswa_id', 'id');
    }
}
