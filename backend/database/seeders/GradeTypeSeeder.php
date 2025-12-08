<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GradeType;

class GradeTypeSeeder extends Seeder
{
    public function run(): void
    {
        $gradeTypes = [
            ['type' => 'зачет', 'created_at' => now(), 'updated_at' => now()],
            ['type' => '5', 'created_at' => now(), 'updated_at' => now()],
            ['type' => '4', 'created_at' => now(), 'updated_at' => now()],
            ['type' => '3', 'created_at' => now(), 'updated_at' => now()],
            ['type' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'незачет', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'на доработке', 'created_at' => now(), 'updated_at' => now()],
        ];

        GradeType::insert($gradeTypes);
    }
}