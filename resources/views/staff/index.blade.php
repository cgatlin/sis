@props ([
    'staff' => [],
])

<x-layout title='FIT - Staff List'>

    <div class="bg-secondary p-4">
        <h1 class="text-xl">List of Staff</h1>
        @if (auth()->user()->role === 'admin')
            <a class="btn btn-xs btn-accent text-neutral" href="/staff/create">Create Staff</a>
        @endif
    </div>

    <ul class="list rounded-box shadow-md flex items-center justify-center">
    @foreach ($staff as $user)
        <li class="list-row shadow">
            <a href="/staff/{{ $user->id }}">{{ $user->name }}</a>
        </li>
    @endforeach
    </ul>

</x-layout>