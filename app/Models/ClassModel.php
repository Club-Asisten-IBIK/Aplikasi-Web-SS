<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'class';
    protected $primaryKey = 'classid';
    public $timestamps = true;

    protected $fillable = [
        'teacherid',
        'classname',
        'gradelevel',
        'capacity',
        'isactive'
    ];

    protected $casts = [
        'isactive' => 'boolean'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacherid', 'teacherid');
    }
}
