<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(
            [
                [
                    'name' => 'Nordic Chair',
                    'price' => rand(40, 200),
                ],
                [
                    'name' => 'Kruzo Aero Chair',
                    'price' => rand(40, 200),
                ],
                [
                    'name' => 'Ergonomic Chair',
                    'price' => rand(40, 200),
                ]
            ]
        );
    }
}
