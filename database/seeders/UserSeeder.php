<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'usr_name' => 'admin',
            'usr_email' => 'admin@gmail.com',
            'usr_password' => bcrypt('11111111'),
            'usr_shp_name' => 'Admin Shop',
            'usr_phone' => '0123456789',
            'usr_address' => '123 Admin St, Admin City',
            'usr_img' => null,
        ]);
    }
}
