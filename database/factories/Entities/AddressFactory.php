<?php

namespace Database\Factories\Entities;

use App\Models\Entities\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entities\Address>
 */
class AddressFactory extends Factory
{

    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $faker = FakerFactory::create('pt_BR');

        return [
            'city' => $faker->city(),
            'neighborhood' => $faker->citySuffix(),
            'road' => $faker->streetName(),
            'cep' => $faker->postcode(),
        ];
    }
}
