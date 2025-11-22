<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    protected $model = Group::class;

    public function definition(): array
    {
        return [
            'name' => strtoupper(fake()->randomLetter()) . '-' . fake()->numberBetween(10, 99),
            'course' => fake()->numberBetween(1, 4),
            'created_at' => fake()->dateTimeBetween('-2 years'),
            'updated_at' => fake()->dateTimeBetween('-2 years'),
        ];
    }
}