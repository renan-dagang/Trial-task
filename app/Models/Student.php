<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'grade', 'has_scholarship'];

    public function courses()
    {
    return $this->belongsToMany(Course::class, 'course_enrollments')->withTimestamps();
    }
}
