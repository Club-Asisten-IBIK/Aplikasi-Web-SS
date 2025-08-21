<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePreviledge extends Model
{
    use HasFactory;
    protected $table = 'rolepreviledge';
    protected $primaryKey = 'rolepreviledgeid';
    public $timestamps = false;

    protected $fillable = [
        'roleid',
        'read',
        'create',
        'modify',
        'delete',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'roleid', 'roleid');
    }
}
