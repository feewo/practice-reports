<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Group;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Internship;
use App\Models\Report;
use App\Models\Grade;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        
        User::truncate();
        Group::truncate();
        Student::truncate();
        Teacher::truncate();
        Internship::truncate();
        Report::truncate();
        Grade::truncate();
        
        Schema::enableForeignKeyConstraints();

        $this->call([
            GroupSeeder::class,
            UserSeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,
            InternshipSeeder::class,
            ReportSeeder::class,
            GradeSeeder::class,
        ]);
    }
}