<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_details')->insert([
            [
                'order_id' => 1,
                'product_id' => 1,
                'price' => 10.99,
                'discount_price' => 10.99,
                'amount' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 1,
                'product_id' => 2,
                'price' => 25.99,
                'discount_price' => 25.99,
                'amount' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'product_id' => 3,
                'price' => 7.99,
                'discount_price' => 7.99,
                'amount' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more data here...
        ]);
    }
}
