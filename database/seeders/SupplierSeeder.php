<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generate 10 random products
        for ($i = 0; $i < 10; $i++) 
        {
            Supplier::create([
                'name' => $faker->company,
                'slug' => $faker->unique()->slug,
                'short_details' => $faker->paragraph($nb =8),
                'contactNumber' => $faker->phoneNumber,
                'contactPerson' => $faker->name,
            ]);
        }

    }
}
