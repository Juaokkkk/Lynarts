<?php

namespace Database\Factories\Products;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Products\Clothes;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products\Clothes>
 */
class ClothesFactory extends Factory
{
    protected $model = Clothes::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $faker = FakerFactory::create('pt_BR');

        return [
            'description' => fake()->word(),
            'price' => fake()->randomFloat(2, 0, 1000),
            'amount' => fake()->randomNumber(2),
        ];
    }
}
