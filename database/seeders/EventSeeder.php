<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('events')->insert(
            [
                [
                    'name' => 'su kien sinh nhat',
                    'type' => 1,
                    'unit' => 1,
                    'des'  => '',
                    'status' => 0,
                ],
                [
                    'name' => 'su kien dau nam',
                    'type' => 2,
                    'unit' => 1.01,
                    'des'  => '',
                    'status' => 0,
                ],
                [
                    'name' => 'su kien mua sam',
                    'type' => 1,
                    'unit' => 2,
                    'des'  => '',
                    'status' => 0,
                ],
                [
                    'name' => 'su kien giang sinh',
                    'type' => 2,
                    'unit' => 2.43,
                    'des'  => '',
                    'status' => 0,
                ],
                [
                    'name' => 'su kien tet',
                    'type' => 1,
                    'unit' => 2,
                    'des'  => '',
                    'status' => 0,
                ],
                
            ]
        );
    }
}
