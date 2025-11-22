<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Internship;


class InternshipSeeder extends Seeder
{
    public function run(): void
    {
        // Обычные практики
        Internship::factory()->count(2)->create();
        
        // Завершенные практики
        Internship::factory()->count(2)->completed()->create();
        
        // Текущие практики
        Internship::factory()->count(2)->current()->create();
    }
}