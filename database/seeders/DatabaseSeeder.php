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
        Product::factory(20)->create();
        Category::factory(5)->create();

        foreach (Product::all() as $product) {
            $categories = Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $product->categories()->attach($categories);
        }

        $users = User::query()->where('is_admin', '!=', true)->get();
        foreach ($users as $user) {
            $products = Product::inRandomOrder()->limit(10)->get();
            foreach ($products as $product) {
                Comment::query()->create([
                    'product_id' => $product->id,
                    'user_id' => $user->id,
                    'description' => $faker->paragraph,
                    'rating' => $faker->numberBetween(1, 5),
                    'picture' => $faker->imageUrl(200, 200, 'comments', true, 'products', true)
                ]);
            }
            $commentsToLike = Comment::inRandomOrder()->limit(5)->get();
            foreach ($commentsToLike as $comment) {
                Like::query()->create([
                    'comment_id' => $comment->id,
                    'user_id' => $user->id
                ]);
            }

            $commentsToDislike = Comment::inRandomOrder()->limit(5)->get();
            foreach ($commentsToDislike as $comment) {
                Dislike::query()->create([
                    'comment_id' => $comment->id,
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
