@props ([
    'date',
    'course',
    'records'
])

<x-layout>
    <div class="bg-secondary p-4">
        <h1>
            <span class="uppercase">Editing Attendance for {{ $date }}</span>
        </h1>
    </div>

    <div class="flex items-center justify-center bg-gray-100">
        <form class="bg-white shadow-md rounded w-90 px-8 p-6 mb-4 mt-2" method="POST" action="/courses/{{ $course->id }}/attendance">
            @csrf
            @method('PATCH')

            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <input type="hidden" name="date" value="{{ $date }}">

            @foreach($records as $record)
                <div>
                    
                    <label class="select mb-2">
                        <span class="label w-full p-4">{{ $record->student->last_name }}, {{ $record->student->first_name }} {{ $record->student->middle_name }}</span>
                        <select name="attendance[{{ $record->student->id }}]">
                            <option value="present" @selected($record->status === 'present')>Present</option>
                            <option value="absent" @selected($record->status === 'absent')>Absent</option>
                        </select>
                    </label>
                </div>
            @endforeach

            <button class="btn btn-xs btn-secondary text-neutral p-2" type="submit">Save Attendance</button>
        </form>
    </div>
</x-layout>