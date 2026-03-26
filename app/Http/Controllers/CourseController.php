<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $courses = Course::all();

        return view('courses.index', ['courses' => $courses]);
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

    /**
     * Update the specified resource to enroll a student.
     */
    public function enrollStudent(Request $request, Course $course)
    {
        //
        $course->students()->syncWithoutDetaching([$request->selected_student]);

        return redirect("/courses/{$course->id}");
    }

    public function removeStudent(Course $course, Student $student)
    {
        //
        $course->students()->detach($student->id);

        return redirect("/courses/{$course->id}");
    }
}
