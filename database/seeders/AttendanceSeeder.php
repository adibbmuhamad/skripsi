<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\Student;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        $students = Student::all();

        foreach ($students as $student) {
            Attendance::create([
                'student_id' => $student->id,
                'date' => now()->subDays(rand(1, 10)),  // Absensi dalam 10 hari terakhir
                'status' => rand(0, 1) ? 'present' : 'absent',  // Status hadir atau absen
            ]);
        }
    }
}
