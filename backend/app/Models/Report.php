<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'internship_id', 'file_name', 'file_path'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function internship()
    {
        return $this->belongsTo(Internship::class);
    }
    
    public function grade()
    {
        return $this->hasOne(Grade::class);
    }

    public function getFileUrlAttribute()
    {
        return Storage::disk('public')->url($this->file_path);
    }

    public function getFileExistsAttribute()
    {
        return Storage::disk('public')->exists($this->file_path);
    }
}