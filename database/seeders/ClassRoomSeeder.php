<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassRoom;
use Faker\Factory as Faker;

class ClassRoomSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID'); // Menggunakan locale Indonesia

        $kelas = ['7A', '7B', '8A', '8B', '9A', '9B'];

        foreach ($kelas as $name) {
            ClassRoom::create([
                'name' => $name,
                'room_number' => $faker->numberBetween(101, 199), // Menghasilkan nomor ruangan acak
                'capacity' => $faker->numberBetween(20, 40), // Menghasilkan kapasitas acak
                'class_teacher' => $faker->name(), // Menghasilkan nama wali kelas acak
            ]);
        }
    }
}
