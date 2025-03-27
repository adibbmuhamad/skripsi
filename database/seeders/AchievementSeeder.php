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

        // Memastikan ada siswa sebelum membuat pencapaian
        if ($students->isEmpty()) {
            return; // Tidak ada siswa, tidak perlu melanjutkan
        }

        // Daftar kategori dalam bahasa Indonesia
        $categories = ['Sains', 'Seni', 'Olahraga', 'Teknologi', 'Sastra'];

        foreach ($students as $student) {
            Achievement::create([
                'student_id' => $student->id,
                'achievement_name' => $faker->sentence(3), // Menghasilkan nama pencapaian yang lebih deskriptif
                'category' => $faker->randomElement($categories), // Memilih kategori acak dari daftar
                'description' => $faker->paragraph(2), // Menghasilkan deskripsi yang lebih panjang
                'date' => $faker->dateTimeBetween('2023-01-01', '2025-12-31')->format('Y-m-d'), // Menghasilkan tanggal acak dalam rentang 2023-2025
            ]);
        }
    }
}
