@props ([
    'user',
])
<x-layout title='FIT - Staff Details'>

<div>
    <div class="bg-secondary p-4">
        <h1>
            <span class="uppercase">{{ $user->name }}</span>
            <div>
                <a class="btn btn-xs btn-accent text-neutral" href="/staff/{{ $user->id }}/edit">Edit</a>

                <form action="/staff/{{ $user->id }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-xs btn-error text-neutral" type="submit">Delete</button>
                </form>
            </div>
        </h1>
    </div>
    
    <h1 class="p-2">Courses Teaching:</h1>

    <ul class="list rounded-box shadow-md flex items-center justify-center">
        @foreach ($user->courses as $course)
            <li class="list-row shadow">
                <a href="/courses/{{ $course->id }}">{{ $course->course_code }} - {{ $course->course_name }}</a>
            </li>
        @endforeach
    </ul>


</div>

</x-layout>