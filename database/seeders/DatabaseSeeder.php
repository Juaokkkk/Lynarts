<?php

namespace Database\Seeders;

use App\Models\Entities\Customer;
use App\Models\Sales\Method;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Database\Seeders\CustomerSeeder;
use Database\Seeders\ClothesSeeder;
use Database\Seeders\SizeSeeder;
use Database\Seeders\StyleSeeder;
use Database\Seeders\MethodSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {

        $this->call([

            CustomerSeeder::class,
            SizeSeeder::class,
            StyleSeeder::class,
            ClothesSeeder::class,
            MethodSeeder::class
            
        ]);

    }
}