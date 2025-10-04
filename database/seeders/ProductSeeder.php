<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'prd_usr_id' => 1,
            'created_by' => 1,
            'prd_code' => 'PRD001',
            'prd_name' => 'Mie Goreng Spesial',
            'prd_price' => 15000,
            'prd_description' => 'Mie goreng dengan tambahan telur, ayam, dan sayur.',
            'prd_stock' => 50,
            'prd_img' => 'mie_goreng_spesial.jpg',
        ]);
    }
}
