<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'name' => 'Hansel',
            'email' => 'hansel@gmail.com',
            'password' => md5('123456'),
            'image_url' => '',
            'role' => '1'
        ],
        [
            'name' => 'hendra',
            'email' => 'hendra@gmail.com',
            'password' => md5('123456'),
            'image_url' => '',
            'role' => '2'
        ],
        [
            'name' => 'jess',
            'email' => 'jess@gmail.com',
            'password' => md5('123456'),
            'image_url' => '',
            'role' => '2'
        ]]);
    }
}