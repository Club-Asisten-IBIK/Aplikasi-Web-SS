<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    use HasFactory;
    protected $table = 'studentpayment';
    protected $primaryKey = 'studentpaymentid';
    public $timestamps = false;
    protected $fillable = [
        'studentbillid',
        'amount',
        'paymentdate',
        'receipt',
        'paymentmethod'
    ];
}
