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
        'classid',
        'student_number',
        'fullname',
        'nickname',
        'birthplace',
        'birthdate',
        'gender',
        'religion',
        'nationality',
        'siblings_full',
        'siblings_step',
        'siblings_adopted',
        'home_language',
        'address',
        'living_with',
        'distance_km',
        'photo',
        'status',
        'datejoin',
        'studentfeeamount',
        'contract',
    ];

    // Relasi ke Parent
    public function parent()
    {
        return $this->hasOne(ParentModel::class, 'studentid', 'studentid');
    }

    // Relasi ke SchoolYear
    public function schoolyear()
    {
        return $this->belongsTo(SchoolYear::class, 'schoolyearid', 'schoolyearid');
    }

    // Relasi ke Class
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'classid', 'classid');
    }

    public function physicalRecords()
    {
        return $this->hasOne(Physical_Records::class, 'studentid', 'studentid');
    }
    public function educationalHistories()
    {
        return $this->hasMany(Educational_Histories::class, 'studentid', 'studentid');
    }
    public function leavingRecords()
    {
        return $this->hasMany(LeavingRecords::class, 'studentid', 'studentid');
    }
}
