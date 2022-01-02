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
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => null,
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'created_at' => date($today),
            'updated_at' => date($today),
        ]);
    }
}
