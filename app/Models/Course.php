<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\CourseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    /** @use HasFactory<CourseFactory> */
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'User');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
