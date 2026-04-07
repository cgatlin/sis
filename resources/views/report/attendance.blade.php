@props([
    'course',
    'records',
    'dateStart',
    'dateEnd'
])


<x-layout>

    <div class="bg-secondary p-4">
        <h1>
            @if ( $dateStart && $dateEnd )
                <span class="uppercase">Attendance for {{ $dateStart }} - {{ $dateEnd }}</span>
            @else
                <span class="uppercase">Attendance for All</span>
            @endif
            
            <div>
                <form class="" method="GET">
                    <input class="input shadow bg-primary w-30" type="date" name="start_date" value="{{ $dateStart }}">
                    <input class="input shadow bg-primary w-30" type="date" name="end_date" value="{{ $dateEnd }}">
                    <button class="btn btn-xs btn-accent text-neutral" type="submit">Filter</button>
                </form>
            </div>
        </h1>
    </div>

    <a class="btn btn-xs btn-info" href="/courses/{{ $course->id }}/export-attendance">Export Attendance</a>

    <div class="overflow-x-auto place-items-center justify-center">
        <table class="table table-zebra w-90">
            <tr>
                <th>Student</th>
                <th>Date</th>
                <th>Status</th>
            </tr>

            @foreach($records as $record)
                <tr>
                    <td>{{ $record->student->last_name }}, {{ $record->student->first_name }} {{ $record->student->middle_name }}</td>
                    <td>{{ $record->attendance_date }}</td>
                    <td>{{ $record->status }}</td>
                </tr>
            @endforeach
        </table>
    </div>


</x-layout>