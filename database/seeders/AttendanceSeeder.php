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
        $startDate = Carbon::create(2025, 1, 1); // 1 Januari 2025
        $endDate = Carbon::create(2025, 2, 29); // 29 Februari 2025
        $totalDays = $startDate->diffInDays($endDate) + 1; // Total 60 hari

        foreach ($students as $student) {
            $currentDate = $startDate->copy();

            for ($i = 0; $i < $totalDays; $i++) {
                $status = $this->generateStatus($currentDate);
                $permissionReason = $status === 'permission' ? $this->generatePermissionReason($faker) : null;

                Attendance::create([
                    'student_id' => $student->id,
                    'date' => $currentDate->format('Y-m-d'),
                    'time' => $faker->time('H:i:s'),
                    'status' => $status,
                    'permission_reason' => $permissionReason,
                ]);

                $currentDate->addDay();
            }
        }
    }

    private function generateStatus($date)
    {
        $rand = rand(1, 100);
        $isWeekend = $date->isWeekend();

        if ($isWeekend) {
            return match(true) {
                $rand <= 70 => 'present',   // 70% hadir di weekend
                $rand <= 85 => 'absent',    // 15% absen
                default => 'permission'     // 15% izin
            };
        }

        return match(true) {
            $rand <= 85 => 'present',   // 85% hadir di weekdays
            $rand <= 95 => 'absent',    // 10% absen
            default => 'permission'     // 5% izin
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
