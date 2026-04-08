@props ([
    'students' => [],
])

<x-layout title='FIT - Students List'>
    <div class="bg-secondary p-4">
        <h1 class="text-xl">List of Students</h1>
        @if (auth()->user()->role === 'admin')
            <a class="btn btn-xs btn-accent text-neutral" href="/students/create">Create New Student</a>
        @endif
    </div>

    <ul class="list rounded-box shadow-md flex items-center justify-center">
    @foreach ($students as $student)
        <li class="list-row shadow">
            <a href="/students/{{ $student->id }}">{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}</a>
        </li>
    @endforeach
    </ul>

    @if ($students instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {{ $students->links() }}
    @endif

</x-layout>