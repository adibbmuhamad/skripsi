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

         // Daftar kategori dalam bahasa Indonesia
        $categories = ['Sains', 'Seni', 'Olahraga', 'Teknologi', 'Sastra'];
        foreach ($students as $student) {
            Achievement::create([
                'student_id' => $student->id,
                'achievement_name' => $faker->word(), // Menghasilkan kata dalam bahasa Indonesia
                'category' => $faker->randomElement($categories), // Memilih kategori acak dari daftar
                'description' => $faker->sentence(), // Menghasilkan kalimat dalam bahasa Indonesia
                'date' => $faker->date(), // Menghasilkan tanggal acak
            ]);
        }
    }
}
