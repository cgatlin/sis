<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Course;
use App\Models\Enrollment;

class Student extends Model
{
    //
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }

}
