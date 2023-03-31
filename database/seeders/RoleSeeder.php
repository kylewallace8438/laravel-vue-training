<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            [
                [
                    'type' => 'Product',
                    'action' => 'View',
                ],
                [
                    'type' => 'Product',
                    'action' => 'Create',
                ],
                [
                    'type' => 'Product',
                    'action' => 'Update',
                ],
                [
                    'type' => 'Product',
                    'action' => 'Delete',
                ],
                [
                    'type' => 'Customer',
                    'action' => 'View',
                ],
                [
                    'type' => 'Order',
                    'action' => 'View',
                ],
                [
                    'type' => 'Order',
                    'action' => 'Update',
                ],
                [
                    'type' => 'Order',
                    'action' => 'Delete',
                ],
            ]
        );
    }
}
