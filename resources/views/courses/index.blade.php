@props ([
    'courses' => [],
])

<x-layout title='FIT - Courses List'>

@foreach ($courses as $course)
    <div><a href="/courses/{{ $course->id }}">{{ $course->course_code }}, {{ $course->course_name }}</a></div>
@endforeach


</x-layout>