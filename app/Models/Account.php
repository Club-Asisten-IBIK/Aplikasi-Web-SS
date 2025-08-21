<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table = 'account';
    protected $primaryKey = 'accountcode';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['accountcode', 'name', 'isactive'];
}
