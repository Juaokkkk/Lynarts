<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Entities\Customer;
use App\Models\Entities\Address;
use App\Models\Entities\Number;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
