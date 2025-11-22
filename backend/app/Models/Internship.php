<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Internship extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title', 'start_date', 'end_date', 'teacher_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}