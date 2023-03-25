<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = [
            [
                'id' => 1, 
                'user_id' => 1, 
                'coupon_id' => 1, 
                'status' => 0,
                'address' => 'Ha Tinh', 
                'create_time' => '2023-03-22 13:45:00',
                'return_time' => '2023-03-23 19:45:00', 
            ],[
                'id' => 2, 
                'user_id' => 2, 
                'coupon_id' => 1, 
                'status' => 0,
                'address' => 'Ha Tinh', 
                'create_time' => '2023-03-21 13:45:00',
                'return_time' => '2023-03-22 19:45:00', 
            ],
        ];

        DB::table('orders')->insert($orders);
    }
}