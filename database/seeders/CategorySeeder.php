<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = Carbon::now();
        DB::table('categories')->insert([
            [
                'name' => 'Accessories',
                'created_at' => date($today),
                'updated_at' => date($today),
            ],
            [
                'name' => 'Basket',
                'created_at' => date($today),
                'updated_at' => date($today),
            ],
            [
                'name' => 'Kitchenware',
                'created_at' => date($today),
                'updated_at' => date($today),
            ],
            [
                'name' => 'Wall Decoration',
                'created_at' => date($today),
                'updated_at' => date($today),
            ],
        ]);
    }
}
