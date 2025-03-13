<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\ClassRoom;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID'); // Menentukan locale Indonesia

        // Ambil semua class room yang ada
        $classRooms = ClassRoom::all();

        // Membuat 100 siswa untuk setiap class room
        foreach ($classRooms as $classRoom) {
            foreach (range(1, 10) as $index) { // Ubah 10 menjadi 100
                Student::create([
                    'name' => $faker->name(), // Nama acak dalam bahasa Indonesia
                    'class_room_id' => $classRoom->id, // Menggunakan ID class room
                    'parent_email' => $faker->email(), // Email orangtua acak
                    'nisn' => $faker->numerify('##########'), // Menghasilkan NISN berupa angka acak
                    'address' => $faker->address(), // Alamat acak
                ]);
            }
        }
    }
}
