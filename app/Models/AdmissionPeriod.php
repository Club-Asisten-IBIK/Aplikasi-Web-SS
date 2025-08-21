<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionPeriod extends Model
{
    use HasFactory;
    protected $table = 'admissionperiod';
    protected $primaryKey = 'admissionperiodid';
    public $timestamps = false;
    protected $fillable = [
        'schoolyearid',
        'periodname',
        'start_date',
        'end_date',
        'is_active'
    ];
}
