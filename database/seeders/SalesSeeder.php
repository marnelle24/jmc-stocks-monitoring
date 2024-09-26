<?php

namespace Database\Seeders;

use App\Models\Sales;
use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Assuming you have products in your products table
        $products = Product::all();

        // Check if products exist before seeding sales
        if ($products->count() == 0) {
            $this->command->info('No products found, skipping Sales seeder.');
            return;
        }

        // Seed 50 sales records
        for ($i = 0; $i < 30; $i++) 
        {
            $product = $products->random();

            Sales::create([
                'sales_order_no'  => $faker->unique()->numerify('SO####'),
                'customer_name'   => $faker->name,
                'total_amount'    => $faker->numberBetween(250, 5000),
                'sale_date'       => $faker->dateTimeThisYear(),
            ]);
        }
    }
}
