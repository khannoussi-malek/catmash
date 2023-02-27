<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $catImages = file_get_contents('cat_images.txt');
        $images = explode("\n", $catImages);
        foreach ($images as $image) {
            if($image !==""){
                $image = trim($image);
                if (empty($image)) {
                    continue;
                }
                DB::table('cats')->insert([
                    'name' => $faker->name,
                    'url' => $image,
                    'rank' => 100,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

    }
}
