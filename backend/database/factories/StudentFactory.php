<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'surname' => fake()->lastName(),
            'name' => fake()->firstName(),
            'patronymic' => fake()->firstName(),
            'group_id' => Group::factory(),
            'created_at' => fake()->dateTimeBetween('-1 year'),
            'updated_at' => fake()->dateTimeBetween('-1 year'),
        ];
    }
}
