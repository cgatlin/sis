<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\AttendanceStatus;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
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

        $query = Course::withCount('students');
        $semester = $request->input('semester', 'All');
        $year = $request->input('year', 'All');

        if ($semester && $semester !== 'All') {
            $query->where('semester', $semester);
        }

        if ($year && $year !== 'All') {
            $query->where('year', $year);
        }

        $courses = $query->get();

        $labels = [];
        foreach ($courses as $course) {
            $labels[] = $course->course_code.'-'.$course->semester.':'.$course->year;
        }

        // $labels = $courses->pluck('course_code');
        $data = $courses->pluck('students_count');

        return view('dashboard.index', [
            'studentsCount' => $studentsCount,
            'coursesCount' => $coursesCount,
            'teachersCount' => $teachersCount,
            'presentToday' => $presentToday,
            'absentToday' => $absentToday,
            'labels' => $labels,
            'data' => $data,
            'semester' => $semester,
            'year' => $year,
        ]);
    }

    public function export()
    {

        $courses = Course::withCount('students')->get();

        $labels = [];
        $data = $courses->pluck('students_count', 'id');
        foreach ($courses as $course) {
            $labels[$course->id] = [
                'label' => $course->course_code.'-'.$course->semester.':'.$course->year,
                'count' => $data[$course->id],
            ];
        }

        $fileName = 'course_distribution.csv';

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
        ];

        $callback = function () use ($labels) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['Course', 'Count']);

            foreach ($labels as $label) {
                fputcsv($file, [
                    $label['label'],
                    $label['count'],
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
