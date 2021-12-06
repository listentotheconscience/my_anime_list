<?php

namespace Database\Factories;

use App\Enums\Countries;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//        $url = $this->faker->imageUrl();
//        $url = Storage::download($url,  Str::random(20));
        return [
            'name' => $this->faker->company(),
            'country' => Countries::getRandomInstance(),
            'image' => 'images/' . $this->faker->image('public/storage/images', 640, 480, null, false)
        ];
    }
}
