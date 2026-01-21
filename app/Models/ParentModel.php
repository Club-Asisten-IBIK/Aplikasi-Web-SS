<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    use HasFactory;

    protected $table = 'parents';
    protected $primaryKey = 'id';

    protected $fillable = [
        'siswa_id',
        'nama_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'siswa_id', 'id');
    }

    public function userrole()
    {
        return $this->hasMany(UserRole::class, 'parentid', 'id');
    }
}
