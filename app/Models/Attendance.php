<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'date', 'status', 'permission_reason', 'time',
    ];

    // Relasi dengan Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
