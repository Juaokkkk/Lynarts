<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('methods')->insert([
            'name' => 'Crédito',
            'tax' => 3.59,
            'created_at' => now()
        ]);
        DB::table('methods')->insert([
            'name' => 'Debito',
            'tax' => 0.00,
            'created_at' => now()
        ]);
        DB::table('methods')->insert([
            'name' => 'Dinheiro',
            'tax' => 0.00,
            'created_at' => now()
        ]);
        DB::table('methods')->insert([
            'name' => 'Pix',
            'tax' => 0.00,
            'created_at' => now()
        ]);
    }
}
