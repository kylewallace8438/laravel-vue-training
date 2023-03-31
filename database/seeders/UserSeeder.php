<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Nette\Utils\Random;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role_user' => 0,
                'rank_point' => 0,
                'current_point' => 0,
            ],
            [
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password'),
                'role_user' => Rand(1, 2),
                'rank_point' => 0,
                'current_point' => 0,
            ],
            [
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password'),
                'role_user' => Rand(1, 2),
                'rank_point' => 0,
                'current_point' => 0,
            ],
            [
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password'),
                'role_user' => Rand(1, 2),
                'rank_point' => 0,
                'current_point' => 0,
            ],
            [
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password'),
                'role_user' => Rand(1, 2),
                'rank_point' => 0,
                'current_point' => 0,
            ],
            [
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password'),
                'role_user' => Rand(1, 2),
                'rank_point' => 0,
                'current_point' => 0,
            ],
            [
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password'),
                'role_user' => Rand(1, 2),
                'rank_point' => 0,
                'current_point' => 0,
            ],
        ]
        );
    }
}
