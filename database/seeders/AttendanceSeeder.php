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
            // Tentukan status secara acak termasuk 'permission'
            $statusOptions = ['present', 'absent', 'permission'];
            $status = $statusOptions[rand(0, 2)]; // Mengacak status antara present, absent, atau permission

            // Tentukan alasan izin (hanya untuk status permission)
            $permissionReason = $status === 'permission' ? 'Izin Sakit' : null;

            Attendance::create([
                'student_id' => $student->id,
                'date' => now()->subDays(rand(1, 10)),  // Absensi dalam 10 hari terakhir
                'status' => $status,  // Status hadir, absen, atau izin
                'permission_reason' => $permissionReason, // Alasan izin jika statusnya izin
            ]);
        }
    }
}
