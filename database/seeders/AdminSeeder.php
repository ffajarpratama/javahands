<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = Carbon::now();
        $faker = Factory::create();
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'address' => $faker->address,
            'phone' => $faker->phoneNumber,
            'picture' => $faker->imageUrl(200, 200),
            'is_admin' => true,
            'created_at' => date($today),
            'updated_at' => date($today),
        ]);
    }
}
