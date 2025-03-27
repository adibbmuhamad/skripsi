<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID'); // Using Faker with Indonesian locale

        $categories = ['important', 'info', 'event']; // Define the categories in English

        for ($i = 0; $i < 10; $i++) {
            Announcement::create([
                'title' => $faker->sentence(6), // Announcement title
                'category' => $faker->randomElement($categories), // Randomly select a category
                'description' => $faker->sentence(10), // Short description
                'published_at' => Carbon::now()->subDays(rand(1, 30)), // Publication date
            ]);
        }
    }
}
