<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subject';
    protected $primaryKey = 'subjectid';
    protected $guarded = [];

    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'subject_id', 'subjectid');
    }
}
