<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Hoang',
                'email' => 'ph242001@gmail.com',
                'password' => '12345678',
                'remember_token' => 'mk123',
                'role_user' => 2,
                'rank_point' => 0,
                'current_point' => 0,
            ], [
                'id' => 2,
                'name' => 'Bang',
                'email' => 'hbang120401@gmail.com',
                'password' => '12345678',
                'remember_token' => 'mk124',
                'role_user' => 1,
                'rank_point' => 0,
                'current_point' => 0,
            ], [
                'id' => 3,
                'name' => 'Dat',
                'email' => 'tdat160601@gmail.com',
                'password' => '12345678',
                'remember_token' => 'mk125',
                'role_user' => 0,
                'rank_point' => 0,
                'current_point' => 0,
            ],
        ];

        DB::table('users')->insert($users);
    }
}
