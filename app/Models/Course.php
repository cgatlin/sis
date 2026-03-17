<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    //
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }
    
}
