<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    use HasFactory;
    protected $table = 'parent';
    protected $primaryKey = 'parentid';
    public $timestamps = false;
    protected $fillable = ['studentid', 'name', 'status', 'contact'];
}
