<?php

namespace Database\Factories;

use App\Enums\Countries;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class ProducerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $filename = $this->faker->image(null, 640, 400);
        Storage::disk('s3')->put(basename($filename), file_get_contents($filename));
        return [
            'name' => $this->faker->company(),
            'country' => Countries::getRandomInstance(),
            'image' => basename($filename)
        ];
    }
}
