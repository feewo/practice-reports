<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateStudentUser extends Command
{
    protected $signature = 'user:create-student 
                            {login : User login} 
                            {password : User password} 
                            {surname : Student surname} 
                            {name : Student name} 
                            {patronymic : Student patronymic} 
                            {group_id : Student group ID}';
    
    protected $description = 'Create a new user with student profile';

    public function handle()
    {
        DB::transaction(function () {
            $user = User::create([
                'login' => $this->argument('login'),
                'password' => Hash::make($this->argument('password')),
            ]);

            $student = Student::create([
                'user_id' => $user->id,
                'surname' => $this->argument('surname'),
                'name' => $this->argument('name'),
                'patronymic' => $this->argument('patronymic'),
                'group_id' => $this->argument('group_id'),
            ]);

            $this->info('Student user created successfully!');
            $this->info("User ID: {$user->id}");
            $this->info("Student ID: {$student->id}");
        });

        return Command::SUCCESS;
    }
}