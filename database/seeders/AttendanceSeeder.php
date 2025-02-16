<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\Student;
use Carbon\Carbon;
use Faker\Factory as Faker;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $students = Student::all();
        $startDate = Carbon::now()->subDays(30); // Mulai dari 30 hari yang lalu

        foreach ($students as $student) {
            $currentDate = $startDate->copy();

            for ($i = 0; $i < 30; $i++) {
                $status = $this->generateStatus($currentDate);
                $permissionReason = $status === 'permission' ? $this->generatePermissionReason($faker) : null;

                Attendance::create([
                    'student_id' => $student->id,
                    'date' => $currentDate->format('Y-m-d'),
                    'status' => $status,
                    'permission_reason' => $permissionReason,
                ]);

                $currentDate->addDay();
            }
        }
    }

    private function generateStatus($date)
    {
        // Probabilitas status
        $rand = rand(1, 100);
        $isWeekend = $date->isWeekend();

        // Weekend memiliki kemungkinan absen lebih tinggi
        if ($isWeekend) {
            return match(true) {
                $rand <= 70 => 'present',   // 70%
                $rand <= 85 => 'absent',    // 15%
                default => 'permission'     // 15%
            };
        }

        return match(true) {
            $rand <= 85 => 'present',   // 85%
            $rand <= 95 => 'absent',    // 10%
            default => 'permission'     // 5%
        };
    }

    private function generatePermissionReason($faker)
    {
        $reasons = [
            'Sakit',
            'Acara keluarga',
            'Izin ke dokter',
            'Perlu mendampingi orang tua',
            'Ada keperluan penting',
            'Izin tidak masuk sekolah'
        ];

        return $faker->randomElement($reasons);
    }
}
