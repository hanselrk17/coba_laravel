<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction')->insert([[
            'user_id' => 1,
            'list_item' => 'kepiting, lobster', // 2 kepiting, 3 lobster
            'total_quantity' => 5,
            'final_price' => 650000
        ],
        [
            'user_id' => 2,
            'list_item' => 'kepiting',
            'total_quantity' => 10,
            'final_price' => 1000000
        ],
        [
            'user_id' => 3,
            'list_item' => 'kepiting, lobster, udang, kerang',
            'total_quantity' => 16,
            'final_price' => 880000
        ]]);
    }
}
