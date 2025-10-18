<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeavingRecords extends Model
{
    use HasFactory;

    protected $table = 'leaving_records';
    protected $primaryKey = 'leaving_recordid';
    public $timestamps = false;

    protected $fillable = [
        'studentid',
        'entry_type',
        'letter_type',
        'continues_to_institution',
        'from_age_group',
        'destination_institution',
        'destination_age_group_level',
        'transfer_date',
        'exit_date',
        'reason'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentid', 'studentid');
    }
}
