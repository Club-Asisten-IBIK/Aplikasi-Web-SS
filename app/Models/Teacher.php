<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'teacherid';
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employeeid');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'subjectid');
    }
}
