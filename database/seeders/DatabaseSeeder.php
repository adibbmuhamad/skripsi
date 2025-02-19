<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\StudentSeeder;
use Database\Seeders\ViolationSeeder;
use Database\Seeders\AttendanceSeeder;
use Database\Seeders\AchievementSeeder;
use Database\Seeders\AnnouncementSeeder;
use Database\Seeders\HealthReportSeeder;

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
            AnnouncementSeeder::class,
        ]);
    }
}
