<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Violation;
use App\Models\Student;
use Faker\Factory as Faker;


class ViolationSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(); // Inisialisasi Faker

        $students = Student::all();

        foreach ($students as $student) {
            Violation::create([
                'student_id' => $student->id,
                'violation_type' => $faker->word(), // Gunakan Faker untuk membuat data dummy
                'description' => $faker->sentence(), // Gunakan Faker untuk membuat kalimat dummy
            ]);
        }
    }
}
