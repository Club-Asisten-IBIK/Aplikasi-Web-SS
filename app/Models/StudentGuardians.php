<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGuardians extends Model
{
    use HasFactory;
    protected $table = 'student_guardians';
    protected $primaryKey = 'id';

    protected $fillable = [
        'siswa_id',
        'nama',
        'hubungan_keluarga',
        'pendidikan',
        'pekerjaan',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'siswa_id', 'id');
    }
}
