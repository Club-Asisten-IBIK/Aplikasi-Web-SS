<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Physical_Records extends Model
{
    use HasFactory;
    protected $table = 'physical_records';
    protected $primaryKey = 'physical_recordid';
    public $timestamps = false;

    protected $fillable = [
        'studentid',
        'height_cm',
        'weight_kg',
        'blood_type',
        'medical_history',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentid', 'studentid');
    }
}
