<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\StudentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    /** @use HasFactory<StudentFactory> */
    use HasFactory;

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }
}
