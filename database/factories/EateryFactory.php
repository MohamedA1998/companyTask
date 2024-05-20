<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EateryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => $this->faker->sentence(2)
        ];
    }
}
