<?php

namespace Database\Factories;

use App\Models\Internship;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class InternshipFactory extends Factory
{
    protected $model = Internship::class;

    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-6 months', '+1 month');
        $endDate = clone $startDate;
        $endDate->modify('+' . fake()->numberBetween(2, 8) . ' weeks');

        return [
            'title' => fake()->randomElement([
                'Производственная практика',
                'Преддипломная практика',
                'Учебная практика'
            ]),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'teacher_id' => Teacher::factory(),
            'created_at' => fake()->dateTimeBetween('-1 year'),
            'updated_at' => fake()->dateTimeBetween('-1 year'),
        ];
    }

    // Дополнительно
    public function current(): static
    {
        return $this->state(fn (array $attributes) => [
            'start_date' => now()->subWeek(),
            'end_date' => now()->addWeeks(4),
        ]);
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'start_date' => now()->subMonths(3),
            'end_date' => now()->subMonths(2),
        ]);
    }
}
