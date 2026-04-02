@props ([
    'student',
])
<x-layout title='FIT - Student Details'>

<div>
    <div class="bg-secondary p-4">
        <h1>
            <span class="uppercase">{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</span>
            <div>
                <a class="btn btn-xs btn-accent" href="/students/{{ $student->id }}/edit">Edit</a>

                <form action="/students/{{ $student->id }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-xs btn-error" type="submit">Delete</button>
                </form>
            </div>
        </h1>
    </div>
    
    <h1 class="p-2">
        Courses Enrolled: 
        <a class="btn btn-xs btn-soft btn-secondary" href="/students/{{ $student->id }}/enroll-course">Enroll in Courses</a>
    </h1>

    <ul class="list rounded-box shadow-md flex items-center justify-center">
        @foreach ($student->courses as $course)
            <li class="list-row shadow">
                <a href="/courses/{{ $course->id }}">{{ $course->course_code }} - {{ $course->course_name }}</a>
            </li>
        @endforeach
    </ul>


</div>



</x-layout>