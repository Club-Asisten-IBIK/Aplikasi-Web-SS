<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BugdetDetail extends Model
{
    use HasFactory;
    protected $table = 'budgetdetail';
    protected $primaryKey = 'budgetdetailid';
    public $timestamps = false;
    protected $fillable = [
        'categoryid',
        'supplierid',
        'budgetid',
        'budgetname',
        'amount',
        'type',
        'purchasedate',
        'qty',
        'pcs',
        'description'
    ];
}
