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
         $names = [
        'Camiseta Básica',
        'Calça Jeans',
        'Jaqueta de Couro',
        'Vestido Floral',
        'Bermuda Esportiva'
         ];

        $faker = FakerFactory::create('pt_BR');

        return [
            'description' => $this->faker->randomElement($names),
            'price' => fake()->randomFloat(2, 0, 1000),
            'amount' => fake()->randomNumber(2),
        ];
    }
}
