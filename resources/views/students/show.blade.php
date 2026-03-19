@props ([
    'student',
])
<x-layout title='FIT - Student Details'>

<div>
    <h1>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</h1>
    
    <h1>Courses Enrolled:</h1>

    @foreach ($student->courses as $course)
        <div>{{ $course->course_code }} - {{ $course->course_name }}</div>
    @endforeach


</div>

<div>
    <a href="/students/{{ $student->id }}/edit">Edit</a>

    <form action="/students/{{ $student->id }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')

        <button type="submit">Delete</button>
    </form>
</div>

</x-layout>