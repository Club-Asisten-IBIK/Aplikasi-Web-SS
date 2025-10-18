<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educational_Histories extends Model
{
    use HasFactory;

    protected $table = 'educational__histories';
    protected $primaryKey = 'educational_historyid';
    public $timestamps = false;

    protected $fillable = [
        'studentid',
        'institution_name',
        'institution_address',
        'from_age_group',
        'admitted_date',
        'admitted_age_group',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentid', 'studentid');
    }
}
