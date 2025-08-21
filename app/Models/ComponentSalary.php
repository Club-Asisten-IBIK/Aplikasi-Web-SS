<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentSalary extends Model
{
    use HasFactory;
    protected $table = 'componentsalary';
    protected $primaryKey = 'componentid';
    public $timestamps = false;
    protected $fillable = ['componentname'];
}
