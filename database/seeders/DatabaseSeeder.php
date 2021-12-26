<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Dislike;
use App\Models\Like;
use App\Models\Product;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        User::factory(4)->create();
        $this->call([
            AdminSeeder::class,
        ]);
        Product::factory(10)->create();
        Category::factory(5)->create();

        foreach (Product::all() as $product) {
            $categories = Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $product->categories()->attach($categories);
        }

        $users = User::query()->where('id', '!=', 1)->get();
        foreach ($users as $user) {
            $products = Product::inRandomOrder()->take(rand(5, 10))->pluck('id');
            foreach ($products as $product) {
                Comment::query()->create([
                    'product_id' => $product,
                    'user_id' => $user->id,
                    'description' => $faker->paragraph,
                    'rating' => $faker->numberBetween(3, 5),
                    'picture' => $faker->imageUrl(200, 200, 'comments', true, 'products', true)
                ]);
            }
            $comments = Comment::inRandomOrder()->take(rand(5, 10))->pluck('id');
            foreach ($comments as $comment) {
                Like::query()->create([
                    'comment_id' => $comment,
                    'user_id' => $user->id
                ]);

                Dislike::query()->create([
                    'comment_id' => $comment,
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
