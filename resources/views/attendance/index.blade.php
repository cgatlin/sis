@props([
    'records'
])

<x-layout>
    <div class="bg-secondary p-4">
        <h1>
            <span class="uppercase">Attendance Records</span>
        </h1>
    </div>

    <ul class="list rounded-box shadow-md flex items-center justify-center">
    
        @foreach ($records as $record )

        <li class="list-row shadow">
            <a href="/courses/{{ $record->course_id}}/attendance/view?date={{ $record->attendance_date}}">{{ $record->attendance_date}}</a>
        </li>
            
        @endforeach

    </ul>


</x-layout>