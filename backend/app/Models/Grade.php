<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grade extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'report_id', 'grade_type_id', 'comment'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function grade_type()
    {
        return $this->belongsTo(GradeType::class, 'grade_type_id');
    }
}