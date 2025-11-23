<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateTeacherUser extends Command
{
    protected $signature = 'user:create-teacher 
                            {login : User login} 
                            {password : User password} 
                            {surname : Teacher surname} 
                            {name : Teacher name} 
                            {patronymic : Teacher patronymic}';
    
    protected $description = 'Create a new user with teacher profile';

    public function handle()
    {
        DB::transaction(function () {
            $user = User::create([
                'login' => $this->argument('login'),
                'password' => Hash::make($this->argument('password')),
            ]);

            $teacher = Teacher::create([
                'user_id' => $user->id,
                'surname' => $this->argument('surname'),
                'name' => $this->argument('name'),
                'patronymic' => $this->argument('patronymic'),
            ]);

            $this->info('Teacher user created successfully!');
            $this->info("User ID: {$user->id}");
            $this->info("Teacher ID: {$teacher->id}");
        });

        return Command::SUCCESS;
    }
}