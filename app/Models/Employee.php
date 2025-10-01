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
        'fullname',
        'gender',
        'fronttitle',
        'backtitle',
        'contact',
        'email',
        'address'
    ];
    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'employee_id', 'employeeid');
    }

    public function guardian()
    {
        return $this->hasOne(Guardian::class, 'employee_id', 'employeeid');
    }
}
