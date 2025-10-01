<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $table = 'guardians';
    protected $primaryKey = 'guardianid';
    public $timestamps = false;
    protected $guarded = [];
}
