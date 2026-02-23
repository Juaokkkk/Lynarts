<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sizes')->insert([
            'name' => 'PP',
            'created_at' => now()
        ]);

        DB::table('sizes')->insert([
            'name' => 'P',
            'created_at' => now()
        ]);

        DB::table('sizes')->insert([
            'name' => 'M',
            'created_at' => now()
        ]);

        DB::table('sizes')->insert([
            'name' => 'G',
            'created_at' => now()
        ]);

        DB::table('sizes')->insert([
            'name' => 'GG',
            'created_at' => now()
        ]);
        
    }
}
