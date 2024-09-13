<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generate 10 random products
        for ($i = 0; $i < 15; $i++) 
        {
            Category::create([
                'name' => $faker->word,
                'slug' => $faker->unique()->slug,
            ]);
        }
    }
}
