<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;
    protected $table = 'revenue';
    protected $primaryKey = 'revenueid';
    public $timestamps = false;
    protected $fillable = [
        'accountcode',
        'categoryid',
        'accountsource',
        'revenuename',
        'revenueamount',
        'revenue_date',
        'revenuedescription'
    ];
}
