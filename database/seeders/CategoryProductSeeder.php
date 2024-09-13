<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++)
        {
            DB::table('category_product')->insert([
                'category_id' => $faker->numberBetween(1, 15),
                'product_id' => $faker->numberBetween(1, 25),
            ]);
        }
    }
}
