<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Entities\Customer;
use App\Models\Entities\Address;
use App\Models\Entities\Number;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        Customer::factory()
            ->has(Address::factory()->count(1))
            ->has(Number::factory()->count(1))
            ->count(10)
            ->create();

    }
}