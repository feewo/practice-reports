<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\Student;
use App\Models\Internship;
use Illuminate\Support\Str;


class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();
        $internships = Internship::all();
        
        foreach ($students as $student) {
            Report::create([
                'student_id' => $student->id,
                'internship_id' => $internships->random()->id,
                'file_name' => 'report_' . Str::uuid() . '.pdf',
                'file_path' => 'reports/report_' . Str::uuid() . '.pdf',
                'created_at' => now()->subDays(rand(1, 90)),
                'updated_at' => now()->subDays(rand(1, 90)),
            ]);
        }
    }
}