<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class CountryPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //panggil command php artisan g:c
        //buat ngisi table countries
        Artisan::call('g:c');
        //panggil command php artisan g:s all
        //buat ngisi table states
        Artisan::call('g:s all');
    }
}
