<?php

namespace Database\Factories;

use App\Enums\Countries;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

class LicensorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'country' => Countries::getRandomInstance(),
            'image' => 'images/' . $this->faker->image('public/storage/images', 640, 480, null, false)
        ];
    }
}
