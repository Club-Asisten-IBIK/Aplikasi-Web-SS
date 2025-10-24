<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'userrole';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'userid',
        'roleid'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'roleid', 'roleid');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employeeid', 'employeeid');
    }
    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'parentid', 'parentid');
    }
}
