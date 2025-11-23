<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;
use App\Models\Report;
use App\Models\GradeType;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        $reports = Report::all();
        $gradeTypes = GradeType::all();
        
        foreach ($reports as $report) {
            $grade = $gradeTypes->random()->id;
            Grade::create([
                'report_id' => $report->id,
                'grade_type_id' => $grade,
                'comment' => $grade > 4 ? 'Неправильное форматирование' : null,
                'created_at' => $report->created_at,
                'updated_at' => $report->created_at,
            ]);
        }
    }
}