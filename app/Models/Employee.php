<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';
    protected $primaryKey = 'employeeid';
    public $timestamps = false;

    protected $fillable = [
        'roleid',
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

    public function guardian()
    {
        return $this->hasOne(Guardian::class, 'employee_id', 'employeeid');
    }
}
