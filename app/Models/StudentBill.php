<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentBill extends Model
{
    use HasFactory;
    protected $table = 'studentbill';
    protected $primaryKey = 'studentbillid';
    public $timestamps = false;
    protected $fillable = [
        'categoryid',
        'accountsource',
        'billname',
        'billamount',
        'duedate',
        'billstatus'
    ];
}
