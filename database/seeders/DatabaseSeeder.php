<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            ['name' => 'Jeruk',         'category' => 'Minuman', 'variant' => 'Dingin',  'price' => 12000],
            ['name' => 'Jeruk',         'category' => 'Minuman', 'variant' => 'Panas',   'price' => 10000],
            ['name' => 'Teh',           'category' => 'Minuman', 'variant' => 'Manis',   'price' => 8000],
            ['name' => 'Teh',           'category' => 'Minuman', 'variant' => 'Tawar',   'price' => 5000],
            ['name' => 'Kopi',          'category' => 'Minuman', 'variant' => 'Dingin',  'price' => 8000],
            ['name' => 'Kopi',          'category' => 'Minuman', 'variant' => 'Panas',   'price' => 6000],
            ['name' => 'Extra Es Batu', 'category' => 'Extra',   'variant' => '',        'price' => 2000],
            ['name' => 'Mie',           'category' => 'Makanan', 'variant' => 'Goreng',  'price' => 15000],
            ['name' => 'Mie',           'category' => 'Makanan', 'variant' => 'Kuah',    'price' => 15000],
            ['name' => 'Nasi Goreng',   'category' => 'Makanan', 'variant' => '',        'price' => 15000]
        ]);

        DB::table('promos')->insert([
            ['name' => 'Nasi Goreng + Jeruk Dingin', 'price' => 23000]
        ]);

        DB::table('tables')->insert([
            ['name' => 'Meja No 1'],
            ['name' => 'Meja No 2'],
            ['name' => 'Meja No 3']
        ]);
    }
}
