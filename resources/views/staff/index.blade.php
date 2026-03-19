@props ([
    'staff' => [],
])

<x-layout title='FIT - Staff List'>

@foreach ($staff as $user)
    <div><a href="/staff/{{ $user->id }}">{{ $user->name }}</a></div>
@endforeach

</x-layout>