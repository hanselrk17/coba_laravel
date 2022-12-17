<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DetailTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detail_transaction')->insert([[
            'transaction_id' => 1,
            'item_id' => 1,
            'item_name' => 'kepiting',
            'quantity' => 2,
            'price' => 100000,
            'total_price' => 200000
        ],
        [
            'transaction_id' => 1,
            'item_id' => 2,
            'item_name' => 'lobster',
            'quantity' => 3,
            'price' => 150000,
            'total_price' => 450000
        ],
        [
            'transaction_id' => 2,
            'item_id' => 1,
            'item_name' => 'kepiting',
            'quantity' => 10,
            'price' => 100000,
            'total_price' => 1000000
        ],
        [
            'transaction_id' => 3,
            'item_id' => 1,
            'item_name' => 'kepiting',
            'quantity' => 4,
            'price' => 100000,
            'total_price' => 1000000
        ],
        [
            'transaction_id' => 3,
            'item_id' => 2,
            'item_name' => 'lobster',
            'quantity' => 4,
            'price' => 150000,
            'total_price' => 1000000
        ],
        [
            'transaction_id' => 3,
            'item_id' => 3,
            'item_name' => 'udang',
            'quantity' => 4,
            'price' => 80000,
            'total_price' => 1000000
        ],
        [
            'transaction_id' => 3,
            'item_id' => 4,
            'item_name' => 'kerang',
            'quantity' => 4,
            'price' => 20000,
            'total_price' => 1000000
        ]]);
    }
}
