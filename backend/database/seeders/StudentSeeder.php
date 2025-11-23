<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Group;
use App\Models\User;
use Faker\Factory;


class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $groups = Group::all();
        $faker = Factory::create('ru_RU');

        $studentUser = User::where('login', 'student')->first();
        if ($studentUser) {
            Student::create([
                'surname' => $faker->lastName(),
                'name' => $faker->firstName(), 
                'patronymic' => $faker->middleName(),
                'user_id' => $studentUser->id,
                'group_id' => $groups->random()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $users = User::whereNotIn('login', ['teacher', 'student'])
                    ->inRandomOrder()
                    ->take(4)
                    ->get();
        
        foreach ($users as $user) {
            Student::create([
                'surname' => $faker->lastName(),
                'name' => $faker->firstName(),
                'patronymic' => $faker->middleName(),
                'user_id' => $user->id,
                'group_id' => $groups->random()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}