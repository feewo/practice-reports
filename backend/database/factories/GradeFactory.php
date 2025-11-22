<?php

namespace Database\Factories;

use App\Models\Grade;
use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    protected $model = Grade::class;

    public function definition(): array
    {
        $grades = ['5', '4', '3', '2', 'зачет', 'незачет'];
        
        return [
            'report_id' => Report::factory(),
            'grade' => fake()->randomElement($grades),
            'comment' => fake()->boolean(70) ? fake()->text(200) : null, // 70% шанс комментария
            'created_at' => fake()->dateTimeBetween('-1 year'),
            'updated_at' => fake()->dateTimeBetween('-1 year'),
        ];
    }
}
