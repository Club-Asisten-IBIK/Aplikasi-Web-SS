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
        'fullname',
        'gender',
        'fronttitle',
        'backtitle',
        'education',
        'contact',
        'email',
        'address',
        'place_of_birth',
        'birthdate',
        'photo',
        'npwp',
        'marital_status'
    ];

    protected $casts = [
        'birthdate' => 'date'
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
