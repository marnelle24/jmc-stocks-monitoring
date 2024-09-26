<?php

namespace Database\Seeders;

use App\Models\Sales;
use App\Models\Product;
use App\Models\SalesItem;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SalesItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Get all the sales orders
        $salesOrders = Sales::all();

        // Get all the products
        $products = Product::all();

        foreach ($salesOrders as $order) 
        {
            $randomLoop = rand(1, 20);
            for ($i = 0; $i < $randomLoop; $i++)
            {
                $product = $products->random();
                $quantity = rand(1, 50);

                SalesItem::create([
                    'sale_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'productCost' => $product->buying_price,
                    'sellingPrice' => $product->selling_price,
                    'profitPerProduct' => ($product->selling_price - $product->buying_price),
                    'tax_amount' => $product->selling_price - ($product->selling_price*0.12), // 12% tax
                    'totalProfit' => $product->selling_price*$quantity,
                    'created_at' => $order->sale_date
                ]);
            }

        }
    }
}
