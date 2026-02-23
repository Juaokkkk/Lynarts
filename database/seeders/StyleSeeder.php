<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class StyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('styles')->insert([
            'name' => 'BabyLook',
            'created_at' => now()
        ]);

        DB::table('styles')->insert([
            'name' => 'Oversized',
            'created_at' => now()
        ]);

        DB::table('styles')->insert([
            'name' => 'Fitness',
            'created_at' => now()
        ]);

        DB::table('styles')->insert([
            'name' => 'Baby',
            'created_at' => now()
        ]);

    }
}
