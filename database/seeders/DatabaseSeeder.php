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
        //bikin 4 fake user
        User::factory(4)->create();
        $this->call([
            //masukin admin ke database
            AdminSeeder::class,
            //bikin data dummy buat product
            ProductSeeder::class,
            //bikin data dummy buat product
            CategorySeeder::class,
            //buat ngisi table countries sama states
            CountryPackageSeeder::class
        ]);

        //untuk setiap product yang ada di database, jalankan proses di bawah ini
        foreach (Product::all() as $product) {
            //ambil category dalam jumlah acak antara 1-3, ambil idnya aja
            $categories = Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
            //hubungin product ke category
            //1 product bisa punya antara 1-3 category
            $product->categories()->attach($categories);
        }

        //ambil semua user di database yang bukan admin
        $users = User::query()->where('is_admin', '!=', true)->get();

        //untuk setiap user, jalankan proses di bawah ini
        foreach ($users as $user) {
            //ambil maksimal 10 product yang ada di database
            $products = Product::inRandomOrder()->limit(10)->get();
            //untuk setiap produk yang diambil, jalankan proses di bawah ini
            foreach ($products as $product) {
                //save comment ke database dengan id dari product di setiap iterasi
                Comment::query()->create([
                    'product_id' => $product->id,
                    'user_id' => $user->id,
                    'title' => $faker->words(3, true),
                    'description' => $faker->paragraphs(3, true),
                    'rating' => $faker->numberBetween(1, 5),
                ]);
            }
            //ambil comment untuk di-like maksimal 5
            $commentsToLike = Comment::inRandomOrder()->limit(5)->get();
            //untuk setiap comment yang diambil, jalankan proses di bawah ini
            foreach ($commentsToLike as $comment) {
                //save like ke database dengan comment_id dari id comment di setiap iterasi
                //dan user_id dari id user di setiap iterasi
                Like::query()->create([
                    'comment_id' => $comment->id,
                    'user_id' => $user->id
                ]);
            }

            //ambil comment untuk di-dislike maksimal 5
            $commentsToDislike = Comment::inRandomOrder()->limit(5)->get();
            //untuk setiap comment yang diambil, jalankan proses di bawah ini
            foreach ($commentsToDislike as $comment) {
                //save like ke database dengan comment_id dari id comment di setiap iterasi
                //dan user_id dari id user di setiap iterasi
                Dislike::query()->create([
                    'comment_id' => $comment->id,
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
