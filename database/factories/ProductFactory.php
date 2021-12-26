<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'picture' => $this->faker->imageUrl(200, 200, 'products', true, 'category', true),
            'price' => $this->faker->numberBetween(200000, 1000000),
            'discount' => $this->faker->numberBetween(20, 50),
            'rating' => $this->faker->randomFloat(1, 1, 5)
        ];
    }
}
