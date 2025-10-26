<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    use HasFactory;

    protected $table = 'parents';
    protected $primaryKey = 'parentid';
    public $timestamps = false;

    protected $fillable = [
        'studentid',
        'name',
        'status',
        'contact',
        'occupation',
        'education',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentid', 'studentid');
    }

    public function userrole()
    {
        return $this->hasMany(UserRole::class, 'parentid', 'parentid');
    }
}
