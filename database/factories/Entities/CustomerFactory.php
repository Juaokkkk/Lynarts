<?php

namespace Database\Factories\Entities;

use App\Models\Entities\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entities\Custumer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create('pt_BR');

        return [
            'name' => $faker->name(),
            'cpf' => $faker->cpf(),
        ];
    }
}
