<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Group;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Internship;
use App\Models\Report;
use App\Models\Grade;
use App\Models\GradeType;


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
        GradeType::truncate();
        
        Schema::enableForeignKeyConstraints();
        
        User::create([
            'login' => 'teacher',
            'password' => Hash::make('123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'login' => 'student',
            'password' => Hash::make('123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->createRandomUsers(8);

        $this->call([
            GradeTypeSeeder::class,
            GroupSeeder::class,
            StudentSeeder::class,
            TeacherSeeder::class,
            InternshipSeeder::class,
            ReportSeeder::class,
            GradeSeeder::class,
        ]);
    }

    private function createRandomUsers(int $count): void
    {
        for ($i = 0; $i < $count; $i++) {
            User::create([
                'login' => 'user' . $i . '_' . Str::random(5),
                'password' => Hash::make('123'),
                'created_at' => now()->subDays(rand(1, 365)),
                'updated_at' => now()->subDays(rand(1, 365)),
            ]);
        }
    }
}