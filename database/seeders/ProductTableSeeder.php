<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([[
            'name' => Str::random(10),
            'price' => 23.3,
        ], [
            'name' => Str::random(10),
            'price' => 25.5,
        ], [
            'name' => Str::random(10),
            'price' => 67.00,
        ]]);
    }
}
