<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID'); // Menentukan locale Indonesia

        // Membuat 10 siswa dummy
        foreach (range(1, 10) as $index) {
            Student::create([
                'name' => $faker->name(), // Nama acak dalam bahasa Indonesia
                'class' => $faker->word(), // Kelas acak (misalnya "X IPA")
                'parent_email' => $faker->email(), // Email orangtua acak
            ]);
        }
    }
}
