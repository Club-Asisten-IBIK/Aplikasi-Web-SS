<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bugdet extends Model
{
    use HasFactory;
    protected $table = 'budget';
    protected $primaryKey = 'budgetid';
    public $timestamps = false;
    protected $fillable = [
        'accountcode',
        'totalbudget',
        'proposedate',
        'approvaldate',
        'paymentsatus'
    ];
}
