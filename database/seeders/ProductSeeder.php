<?php

namespace Database\Seeders;

use App\Models\Description;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 20; $i++) {
            $product = Product::query()->create([
                'name' => $faker->words(3, true),
                'price' => $faker->numberBetween(10, 90),
                'discount' => $faker->numberBetween(20, 50),
            ]);

            Description::query()->create([
                'product_id' => $product->id,
                'material' => $faker->words(3, true),
                'measurement' => $faker->words(3, true),
                'description' => $faker->paragraphs(3, true),
                'additional_note' => $faker->paragraphs(3, true),
            ]);

        }
    }
}
