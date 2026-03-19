@props ([
    'user',
])
<x-layout title='FIT - Staff Details'>

<div>
    <h1>{{ $user->name }}</h1>
    
    <h1>Courses Teaching:</h1>

    @foreach ($user->courses as $course)
        <div>{{ $course->course_code }} - {{ $course->course_name }}</div>
    @endforeach


</div>

<div>
    <a href="/staff/{{ $user->id }}/edit">Edit</a>

    <form action="/staff/{{ $user->id }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')

        <button type="submit">Delete</button>
    </form>
</div>

</x-layout>