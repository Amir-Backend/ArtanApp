<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'phone' => fake()->numerify('09#########'),
            'national_code' => fake()->unique()->numerify('##########'),
            'percentage' => fake()->randomFloat(2, 10, 60),
            'features' => fake()->sentence(8),
        ];
    }
}
