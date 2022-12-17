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
            'qty' => 100,
            'price' => 100000,
            'expired_time' => '2024-12-30',
            'image_url' => ''
        ],
        [
            'name' => 'lobster',
            'qty' => 150,
            'price' => 150000,
            'expired_time' => '2024-12-30',    
            'image_url' => ''
        ],
        [
            'name' => 'udang',
            'qty' => 150,
            'price' => 50000,
            'expired_time' => '2024-12-30',    
            'image_url' => ''
        ],
        [
            'name' => 'kerang',
            'qty' => 200,
            'price' => 20000,
            'expired_time' => '2024-12-30',    
            'image_url' => ''
        ]]);
    }
}
