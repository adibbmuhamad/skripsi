<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'class', 'parent_email',
    ];

    // Relasi dengan Attendance
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Relasi dengan Violation
    public function violations()
    {
        return $this->hasMany(Violation::class);
    }

    // Relasi dengan Achievement
    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    // Relasi dengan HealthReport
    public function healthReports()
    {
        return $this->hasMany(HealthReport::class);
    }
}
