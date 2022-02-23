<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->streetAddress(),
            'phone' => $this->faker->unique()->phoneNumber(),
        ];
    }
}
