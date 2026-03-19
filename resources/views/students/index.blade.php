@props ([
    'students' => [],
])

<x-layout title='FIT - Students List'>

@foreach ($students as $student)
    <div><a href="/students/{{ $student->id }}">{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}</a></div>
@endforeach


</x-layout>