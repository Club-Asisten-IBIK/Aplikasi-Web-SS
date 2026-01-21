<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';
    protected $primaryKey = 'id';

    protected $fillable = [
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
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
        'biaya_pendidikan' => 'double',
        'jarak_km' => 'decimal:2',
    ];

    // Relasi ke Parent
    public function parent()
    {
        return $this->hasOne(ParentModel::class, 'siswa_id', 'id');
    }

    public function physicalRecords()
    {
        return $this->hasOne(Physical_Records::class, 'siswa_id', 'id');
    }

    public function educationalHistories()
    {
        return $this->hasMany(Educational_Histories::class, 'siswa_id', 'id');
    }

    public function leavingRecords()
    {
        return $this->hasMany(LeavingRecords::class, 'siswa_id', 'id');
    }
}
