<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert(
            [
                
                [
                    'name' => Str::random(10),
                    'price' => rand(100, 300),
                ],
                [
                    'name' => Str::random(10),
                    'price' => rand(100, 300),
                ],
                [
                    'name' => Str::random(10),
                    'price' => rand(100, 300),
                ],
                [
                    'name' => Str::random(10),
                    'price' => rand(100, 300),
                ],
            ]
        );
    }
}
