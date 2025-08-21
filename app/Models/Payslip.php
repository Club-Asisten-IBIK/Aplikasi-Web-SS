<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    use HasFactory;
    protected $table = 'payslip';
    protected $primaryKey = 'payslipid';
    public $timestamps = true;
    protected $fillable = [
        'employeeid',
        'schoolyearid',
        'categoryid',
        'accountcode',
        'month',
        'status'
    ];
}
