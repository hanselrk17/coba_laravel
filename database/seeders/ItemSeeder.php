<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item')->insert([[
            'name' => 'kepiting',
            'qty' => 10,
            'price' => 100000,
            'expired_time' => '2024-12-30',
            'image_url' => ''
        ],
        [
            'name' => 'lobster',
            'qty' => 15,
            'price' => 150000,
            'expired_time' => '2024-12-30',    
            'image_url' => ''
        ]]);
    }
}
