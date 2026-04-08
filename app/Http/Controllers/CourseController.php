<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $semester = $request->input('semester', 'All');
        $year = $request->input('year', 'All');

        $courses = Course::when($request, function ($query, $request) {
            if ($request->semester && $request->semester !== 'All') {
                $query->where('semester', $request->semester);
            }

            if ($request->year && $request->year !== 'All') {
                $query->where('year', $request->year);
            }

            return $query;
        })->get();

        return view('courses.index', ['courses' => $courses, 'semester' => $semester, 'year' => $year]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $teachers = User::where('role', 'teacher')->get();

        return view('courses.create', ['teachers' => $teachers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        //

        Course::create($request->validated());

        return redirect('/courses');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
        $students = Student::whereDoesntHave('courses', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })->get();

        return view('courses.show', ['course' => $course, 'students' => $students]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
        $teachers = User::where('role', 'teacher')->get();

        return view('courses.edit', ['course' => $course, 'teachers' => $teachers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCourseRequest $request, Course $course)
    {
        //
        $course->update($request->validated());

        return redirect("/courses/{$course->id}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
        $course->delete();

        return redirect('/courses');
    }

    public function enrollStudentCreate(Course $course)
    {
        //
        $students = Student::whereDoesntHave('courses', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })->get();

        return view('courses.enroll', ['course' => $course, 'students' => $students]);
    }

    /**
     * Update the specified resource to enroll a student.
     */
    public function enrollStudentStore(Request $request, Course $course)
    {
        //
        $course->students()->syncWithoutDetaching([$request->selected_student]);

        return redirect("/courses/{$course->id}/enroll-student");
    }

    public function removeStudent(Course $course, Student $student)
    {
        //
        $course->students()->detach($student->id);

        return redirect("/courses/{$course->id}/enroll-student");
    }

    public function studentReport(Course $course)
    {
        $students = $course->students;

        return view('report.student', ['course' => $course, 'students' => $students]);
    }

    public function attendanceReport(Request $request, Course $course)
    {

        $query = Attendance::where('course_id', $course->id)
            ->with('student');

        $dateStart = null;
        $dateEnd = null;

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('attendance_date', [
                $request->start_date,
                $request->end_date,
            ]);

            $dateStart = $request->start_date;
            $dateEnd = $request->end_date;
        }

        $records = $query->get();

        return view('report.attendance', ['course' => $course, 'records' => $records, 'dateStart' => $dateStart, 'dateEnd' => $dateEnd]);

    }

    public function exportStudents(Course $course)
    {
        $fileName = 'students_course_'.$course->id.'.csv';

        $students = $course->students;

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
        ];

        $callback = function () use ($students) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['First Name', 'Middle Name', 'Last Name']);

            foreach ($students as $student) {
                fputcsv($file, [
                    $student->first_name,
                    $student->middle_name,
                    $student->last_name,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportAttendance(Course $course)
    {
        $fileName = 'attendance_class_'.$course->id.'.csv';

        $records = Attendance::where('course_id', $course->id)
            ->with('student')
            ->orderBy('student_id', 'asc')
            ->get();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
        ];

        $callback = function () use ($records) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['Student', 'Date', 'Status']);

            foreach ($records as $record) {
                fputcsv($file, [
                    $record->student->first_name.' '.$record->student->middle_name.' '.$record->student->last_name,
                    $record->attendance_date,
                    $record->status,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
