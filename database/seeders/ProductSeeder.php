<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generate 10 random products
        for ($i = 0; $i < 25; $i++) 
        {
            $user = User::find(1);
            
            Product::create([
                'name' => $this->generateProductName($faker),
                'supplier_id' => $faker->numberBetween(1, 10),
                'slug' => $faker->unique()->slug,
                'selling_price' => $faker->randomFloat(2, 10, 2000),
                'buying_price' => $faker->randomFloat(2, 10, 2000),
                'description' => $faker->paragraph($nb =8),
                'keyword' => implode(', ', $faker->words($faker->numberBetween(2, 10))),
                'addedBy' => $user->name,
                'photo' => $faker->imageUrl(800, 600, 'business', true, 'Product'),
            ]);
        }
    }

    private function generateProductName($faker)
    {
        return $faker->word . ' ' . ucfirst($faker->word);
    }
}
