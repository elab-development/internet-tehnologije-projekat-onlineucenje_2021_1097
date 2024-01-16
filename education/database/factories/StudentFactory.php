<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->firstName() . " " . fake()->lastName(),
            'gender' => fake()->randomElement(['male', 'female']),
            'birth' => fake()->numberBetween(1950, date("Y") - 18)
        ];
    }
}
