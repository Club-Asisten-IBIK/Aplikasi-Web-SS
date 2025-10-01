<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'student';
    protected $primaryKey = 'studentid';
    public $timestamps = false;
    protected $fillable = [
        'schoolyearid',
        'name',
        'place',
        'birthdate',
        'sex',
        'status',
        'datejoin',
        'studentfeeamount',
        'contract'
    ];
    public function parent()
    {
        return $this->hasOne(ParentModel::class, 'studentid', 'studentid');
    }
    public function schoolyear()
    {
        return $this->belongsTo(SchoolYear::class, 'schoolyearid', 'schoolyearid');
    }
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'classid', 'classid');
    }
}
