<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'report' => $faker->sentence(), // Menghasilkan kalimat acak dalam bahasa Indonesia
            ]);
        }
    }
}
