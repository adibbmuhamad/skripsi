<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HealthReport;
use App\Models\Student;
use Faker\Factory as Faker;

class HealthReportSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID'); // Menentukan locale Indonesia

        $students = Student::all();

        foreach ($students as $student) {
            HealthReport::create([
                'student_id' => $student->id,
                'report_date' => $faker->date(), // Menghasilkan tanggal acak
                'health_status' => $faker->randomElement(['healthy', 'sick', 'recovering']), // Status kesehatan acak
                'report' => $faker->sentence(), // Menghasilkan kalimat acak dalam bahasa Indonesia
                'symptoms' => $faker->sentence(), // Menghasilkan gejala acak
                'doctors_notes' => $faker->paragraph(), // Menghasilkan catatan dokter acak
                'attachments' => null, // Biarkan null atau tambahkan logika untuk file acak
            ]);
        }
    }
}
