@props([
    'date',
    'course',
    'records',
    'presentCount',
    'absentCount'
])


<x-layout>

    <div class="bg-secondary p-4">
        <h1>
            <span class="uppercase">Attendance for {{ $date }}</span>
            <div>
                <a class="btn btn-xs btn-accent text-neutral" href="/courses/{{ $course->id }}/attendance/edit?date={{ $date }}">Edit</a>
            </div>
        </h1>
    </div>

    <div>
        <span>Present: {{ $presentCount }}, Absent: {{ $absentCount }}</span>
    </div>

    <div class="overflow-x-auto place-items-center justify-center">
        <table class="table table-zebra w-90">
            <tr>
                <th>Student</th>
                <th>Status</th>
            </tr>

            @foreach($records as $record)
                <tr>
                    <td>{{ $record->student->last_name }}, {{ $record->student->first_name }} {{ $record->student->middle_name }}</td>
                    <td>{{ $record->status }}</td>
                </tr>
            @endforeach
        </table>
    </div>


</x-layout>