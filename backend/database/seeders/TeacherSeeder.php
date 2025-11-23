<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\User;
use Faker\Factory;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teacherUser = User::where('login', 'teacher')->first();
        $faker = Factory::create('ru_RU');

        if ($teacherUser) {
            Teacher::create([
                'surname' => $faker->lastName(),
                'name' => $faker->firstName(),
                'patronymic' => $faker->middleName(),
                'user_id' => $teacherUser->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $users = User::whereNotIn('login', ['student', 'teacher'])
                    ->inRandomOrder()
                    ->take(4)
                    ->get();
        
        foreach ($users as $user) {
            Teacher::create([
                'surname' => $faker->lastName(),
                'name' => $faker->firstName(),
                'patronymic' => $faker->middleName(),
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}