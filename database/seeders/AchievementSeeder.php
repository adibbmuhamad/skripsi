<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Achievement;
use App\Models\Student;
use Faker\Factory as Faker;

class AchievementSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID'); // Menggunakan locale Indonesia

        $students = Student::all();

        foreach ($students as $student) {
            Achievement::create([
                'student_id' => $student->id,
                'achievement_name' => $faker->word(), // Menghasilkan kata dalam bahasa Indonesia
                'description' => $faker->sentence(), // Menghasilkan kalimat dalam bahasa Indonesia
            ]);
        }
    }
}
