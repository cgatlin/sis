<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Course;
use App\AttendanceStatus;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        //
        $records = Attendance::where('course_id', $course->id)
        ->groupby('attendance_date')
        ->get();

        return view('attendance.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        //
        $students = $course->students;

        return view('attendance.create', compact('course', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        foreach ($request->attendance as $studentId => $status) {

            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'course_id' => $request->course_id,
                    'attendance_date' => $request->date,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect("/courses/$request->course_id");
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
        $date = request('date', now()->toDateString());

        $records = Attendance::where('course_id', $course->id)
            ->where('attendance_date', $date)
            ->with('student')
            ->get();

        $presentCount = Attendance::where('course_id', $course->id)
            ->where('attendance_date', $date)
            ->where('status', AttendanceStatus::PRESENT)
            ->count();

        $absentCount = Attendance::where('course_id', $course->id)
            ->where('attendance_date', $date)
            ->where('status', AttendanceStatus::ABSENT)
            ->count();
        

        return view('attendance.show', compact('course', 'records', 'date', 'presentCount', 'absentCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
        $date = request('date', now()->toDateString());

        $records = Attendance::where('course_id', $course->id)
            ->where('attendance_date', $date)
            ->with('student')
            ->get();

        return view('attendance.edit', compact('course', 'records', 'date'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
        foreach ($request->attendance as $studentId => $status) {

            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'course_id' => $request->course_id,
                    'attendance_date' => $request->date,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect("/courses/$request->course_id");
    }

}
