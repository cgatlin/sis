<?php

declare(strict_types=1);

namespace App\Models;

use App\AttendanceStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    //
    /** @use HasFactory<\Database\Factories\AttendanceFactory> */
    use HasFactory;

    protected $cast = [
        'status' => AttendanceStatus::class,
    ];

    protected $attributes = [
        'status' => AttendanceStatus::PRESENT,
    ];
}
