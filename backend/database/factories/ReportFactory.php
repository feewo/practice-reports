<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\Student;
use App\Models\Internship;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    protected $model = Report::class;

    public function definition(): array
    {
        $fileName = 'report_' . fake()->uuid() . '.pdf';

        return [
            'student_id' => Student::factory(),
            'internship_id' => Internship::factory(),
            'file_name' => $fileName,
            'file_path' => 'reports/' . $fileName,
            'created_at' => fake()->dateTimeBetween('-1 year'),
            'updated_at' => fake()->dateTimeBetween('-1 year'),
        ];
    }
}