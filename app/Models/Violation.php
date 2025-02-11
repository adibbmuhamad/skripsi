<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Violation extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'violation_type', 'description',
    ];

    // Relasi dengan Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
