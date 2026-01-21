<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';
    protected $primaryKey = 'employeeid';

    protected $fillable = [
        'nip',
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'gelar_depan',
        'gelar_belakang',
        'pendidikan',
        'kontak',
        'email',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'foto',
        'npwp',
        'agama',
        'status_perkawinan',
        'tanggal_masuk'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'roleid', 'roleid');
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'employee_id', 'employeeid');
    }

    public function userrole()
    {
        return $this->hasMany(UserRole::class, 'employeeid', 'employeeid');
    }
}
