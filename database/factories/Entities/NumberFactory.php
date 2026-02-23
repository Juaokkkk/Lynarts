<?php

namespace Database\Factories\Entities;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Entities\Number;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entities\Number>
 */
class NumberFactory extends Factory
{
    protected $model = Number::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create('pt_BR');

        return [
            'DDD' => $faker->areaCode(),
            'number' => $faker->cellphone(),
        ];
    }
}
