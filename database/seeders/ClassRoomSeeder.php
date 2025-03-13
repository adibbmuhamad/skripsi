<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassRoom; // Pastikan model diimpor dengan benar

class ClassRoomSeeder extends Seeder
{
    public function run()
    {
        $kelas = ['7A', '7B', '8A', '8B', '9A', '9B'];

        foreach ($kelas as $name) {
            ClassRoom::create(['name' => $name]);
        }
    }
}
