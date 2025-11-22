<?php

namespace App\Services;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;

class RoleService
{
    public static function assignRole(User $user, string $role, array $profileData = [])
    {
        $currentRole = $user->role;
        
        if ($currentRole !== $role) {
            $user->student()->delete();
            $user->teacher()->delete();
        }

        switch ($role) {
            case 'student':
                if ($user->student) {
                    $user->student()->update($profileData);
                    return $user->student;
                }
                return Student::create(array_merge(['user_id' => $user->id], $profileData));
                
            case 'teacher':
                if ($user->teacher) {
                    $user->teacher()->update($profileData);
                    return $user->teacher;
                }
                return Teacher::create(array_merge(['user_id' => $user->id], $profileData));
        }
        
        return false;
    }
}