<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payment';
    protected $primaryKey = 'paymentid';
    public $timestamps = false;
    protected $fillable = [
        'budgetid',
        'amount',
        'paymentdate',
        'receipt',
        'paymentmethod'
    ];
}
