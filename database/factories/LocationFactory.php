<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address'       => $this->faker->address(),
            'latitude'      => $this->faker->randomFloat(7, 30, 30.5),
            'longitude'     => $this->faker->randomFloat(7, 31, 31.5),
        ];
    }
}
