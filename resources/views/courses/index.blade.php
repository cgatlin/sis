@props ([
    'courses' => [],
])

<x-layout title='FIT - Courses List'>
    <div class="bg-secondary p-4">
        <h1 class="text-xl">List of Courses</h1>
            @if (auth()->user()->role === 'admin')
                <a class="btn btn-xs btn-accent text-neutral" href="/courses/create">Create New Course</a>
            @endif
         </div>

    <ul class="list rounded-box shadow-md flex items-center justify-center">
    @foreach ($courses as $course)
        <li class="list-row shadow">
            <a href="/courses/{{ $course->id }}">{{ $course->course_code }}, {{ $course->course_name }}</a>
        </li>
    @endforeach
    </ul>

</x-layout>