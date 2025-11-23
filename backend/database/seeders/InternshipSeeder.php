<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Internship;
use App\Models\Teacher;

class InternshipSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = Teacher::all();
        $internshipNames = [
            'Учебная практика',
            'Производственная практика',
            'Преддипломная практика'
        ];
        
        foreach ($teachers as $teacher) {
            $startDate = now()->subDays(rand(30, 180));
            $endDate = $startDate->copy()->addDays(rand(14, 90));
            
            Internship::create([
                'teacher_id' => $teacher->id,
                'title' => $internshipNames[array_rand($internshipNames)],
                'start_date' => $startDate,
                'end_date' => $endDate,
                'created_at' => now()->subDays(rand(1, 180)),
                'updated_at' => now()->subDays(rand(1, 180)),
            ]);
        }
    }
}