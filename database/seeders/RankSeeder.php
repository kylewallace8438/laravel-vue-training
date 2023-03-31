<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('ranks')->insert(
            [
                [
                    'rank' => 'bronze',
                    'point' => 500,
                ],
                [
                    'rank' => 'silver',
                    'point' => 1000,
                ],
                [
                    'rank' => 'gold',
                    'point' => 1500,
                ],
                [
                    'rank' => 'diamond',
                    'point' => 2000,
                ],
            ]
        );
    }
}
