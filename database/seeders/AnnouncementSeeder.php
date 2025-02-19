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
        $faker = \Faker\Factory::create('id_ID'); // Menggunakan Faker dengan bahasa Indonesia

        for ($i = 0; $i < 10; $i++) {
            Announcement::create([
                'title' => $faker->sentence(6), // Judul pengumuman
                'body' => $faker->paragraphs(3, true), // Isi pengumuman
                'published_at' => Carbon::now()->subDays(rand(1, 30)), // Tanggal publikasi
            ]);
        }
    }
}
