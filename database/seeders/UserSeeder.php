<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Entities\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Raposo',
            'email' => 'raposo@testemail.com',
            'password' => Hash::make(12345678)
        ]);
        
        DB::table('users')->insert([
            'name' => 'MrIohan',
            'email' => 'mriohan@testemail.com',
            'password' => Hash::make(12341234)
        ]);

        User::factory()
        ->count(10)
        ->create();
    }
}
