<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\AttendanceStatus;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;

class DashboardController extends Controller
{
    //
    public function index()
    {
        //
        $studentsCount = Student::count();
        $coursesCount = Course::count();
        $teachersCount = User::where('role', 'teacher')->count();

        $today = now()->toDateString();

        $presentToday = Attendance::where('attendance_date', $today)
            ->where('status', AttendanceStatus::PRESENT)
            ->count();

        $absentToday = Attendance::where('attendance_date', $today)
            ->where('status', AttendanceStatus::ABSENT)
            ->count();

        return view('dashboard.index', ['studentsCount' => $studentsCount, 'coursesCount' => $coursesCount, 'teachersCount' => $teachersCount, 'presentToday' => $presentToday, 'absentToday' => $absentToday]);
    }
}
