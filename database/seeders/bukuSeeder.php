<?php

namespace Database\Seeders;

use App\Models\BukuModel;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class bukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID'); // Using Indonesian locale for more appropriate book titles
        
        // Generate 20 fake book entries
        for ($i = 0; $i < 20; $i++) {
            BukuModel::create([
                'judul_buku' => $faker->sentence(rand(3, 6)), // Random title with 3-6 words
                'penulis' => $faker->name(), // Random author name
                'deskripsi_buku' => $faker->paragraph(rand(6, 9)), // Random description
                'tahun_terbit' => $faker->numberBetween(1980, 2024), // Random year between 1980-2024
            ]);
        }
    }
}