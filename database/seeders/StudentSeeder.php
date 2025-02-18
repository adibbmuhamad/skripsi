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

        $kelas = ['7A', '7B', '8A', '8B', '9A', '9B'];

        // Membuat 10 siswa untuk setiap kelas
        foreach ($kelas as $class) {
            foreach (range(1, 10) as $index) {
                Student::create([
                    'name' => $faker->name(), // Nama acak dalam bahasa Indonesia
                    'class' => $class, // Menggunakan kelas yang sedang diiterasi
                    'parent_email' => $faker->email(), // Email orangtua acak
                    'nisn' => $faker->numerify('##########'), // Menghasilkan NISN berupa angka acak
                    'address' => $faker->address(), // Alamat acak (misalnya alamat lengkap)
                ]);
            }
        }
    }
}
