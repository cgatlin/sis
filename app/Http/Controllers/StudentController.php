<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $students = Student::all();
        $students = Student::paginate(10);

        return view('students.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {

        Student::create($request->validated());

        return redirect('/students');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
        return view('students.show', ['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
        return view('students.edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreStudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        return redirect("/students/{$student->id}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
        $student->delete();

        return redirect('/students');
    }

    public function enrollCourseCreate(Student $student)
    {
        //
        $courses = Course::whereDoesntHave('students', function ($query) use ($student) {
            $query->where('student_id', $student->id);
        })->get();

        return view('students.enroll', ['courses' => $courses, 'student' => $student]);
    }

    /**
     * Update the specified resource to enroll a student.
     */
    public function enrollCourseStore(Request $request, Student $student)
    {
        //
        $student->courses()->syncWithoutDetaching([$request->selected_course]);

        return redirect("/students/{$student->id}/enroll-course");
    }

    public function removeCourse(Student $student, Course $course)
    {
        //
        $student->courses()->detach($course->id);

        return redirect("/students/{$student->id}/enroll-course");
    }
}
