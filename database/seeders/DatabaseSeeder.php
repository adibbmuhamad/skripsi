<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            StudentSeeder::class,
            AttendanceSeeder::class,
            ViolationSeeder::class,
            AchievementSeeder::class,
            HealthReportSeeder::class,
        ]);
    }
}
