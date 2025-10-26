<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'userid';
    public $timestamps = true;

    protected $fillable = [
        'username',
        'password',
        'isactive',
    ];

    protected $hidden = [
        'password'
    ];

    public function userroles()
    {
        return $this->hasMany(UserRole::class, 'userid', 'userid');
    }
}
