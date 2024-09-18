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
        for ($i = 0; $i < 50; $i++) 
        {
            $product = $products->random();

            Sales::create([
                'customer_name'   => $faker->name,
                'product_id'      => $product->id,
                'quantity'        => $faker->numberBetween(1, 50),
                'price'           => $product->selling_price,
                'total'           => $faker->numberBetween(50, 500),
                'sale_date'       => $faker->dateTimeThisYear(),
                'payment_method'  => $faker->randomElement(['cash', 'credit_card', 'paypal']),
                'status'          => $faker->randomElement(['pending', 'completed', 'refunded']),
            ]);
        }
    }
}
