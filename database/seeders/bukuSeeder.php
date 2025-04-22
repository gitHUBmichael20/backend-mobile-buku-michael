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
        $faker = Faker::create('id_ID'); // Lokal Indonesia

        for ($i = 0; $i < 50; $i++) {
            BukuModel::create([
                'judul_buku' => $faker->sentence(rand(3, 6)),
                'penulis' => $faker->name(),
                'deskripsi_buku' => $faker->paragraph(rand(6, 9)),
                'tahun_terbit' => $faker->numberBetween(1980, 2024),
                'sampul_buku' => 'https://picsum.photos/1080/1920?random=' . $i, // Gambar dari Lorem Picsum
            ]);
        }
    }
}
