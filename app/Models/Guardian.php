<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $table = 'guardians';
    protected $primaryKey = 'guardianid';
    public $timestamps = false;
    protected $guarded = [];
    protected $fillable = [
        'employeeid',
        'subjectid'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employeeid', 'employeeid');
    }
}
