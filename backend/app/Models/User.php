<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable = [
        'login',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function profile()
    {
        if ($this->type === 'student' && $this->student) {
            return $this->student;
        } elseif ($this->type === 'teacher' && $this->teacher) {
            return $this->teacher;
        }
        return null;
    }

    public function isStudent()
    {
        return $this->student !== null;
    }

    public function isTeacher()
    {
        return $this->teacher !== null;
    }

    public function getRoleAttribute(): string
    {
        if ($this->isStudent()) return 'student';
        return 'teacher';
    }
}
