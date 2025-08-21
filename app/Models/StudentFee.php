<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    use HasFactory;
    protected $table = 'studentfee';
    protected $primaryKey = 'studentfeeid';
    public $timestamps = false;
    protected $fillable = [
        'studentid',
        'schoolyearid',
        'accountcode',
        'categoryid',
        'notanumber',
        'month',
        'studentfeedate',
        'studentfeeamount'
    ];
}
