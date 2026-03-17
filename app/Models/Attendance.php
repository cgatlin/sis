<?php

declare(strict_types=1);

namespace App\Models;

use App\AttendanceStatus;
use Database\Factories\AttendanceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    /** @use HasFactory<AttendanceFactory> */
    use HasFactory;

    protected $cast = [
        'status' => AttendanceStatus::class,
    ];

    protected $attributes = [
        'status' => AttendanceStatus::PRESENT,
    ];
}
