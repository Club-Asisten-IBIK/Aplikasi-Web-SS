<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'class';
    protected $primaryKey = 'classid';
    public $timestamps = true;
    protected $guarded = [];

    public function guardian()
    {
        return $this->belongsTo(Guardian::class, 'guardianid', 'guardianid');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'classid', 'classid');
    }
}
