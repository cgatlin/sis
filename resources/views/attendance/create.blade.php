@props ([
    'course',
    'students'
])

<x-layout>
    <div class="bg-secondary p-4">
        <h1>
            <span class="uppercase">Taking Attendance for {{ now()->toDateString() }}</span>
        </h1>
    </div>

    <div class="flex items-center justify-center bg-gray-100">
        <form class="bg-white shadow-md rounded w-90 px-8 p-6 mb-4 mt-2" method="POST" action="/courses/{{ $course->id }}/attendance">
            @csrf

            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <input class="input date mb-2" type="hidden" name="date" id="dateInput" value="{{ now()->toDateString() }}">
            <button type="button" class="btn btn-secondary mb-2" id="dateToggle" onclick="changeDate()">Change Date</button>

            <script>
                function changeDate() {
                    // Programmatically change the hidden input value
                    document.getElementById('dateInput').type = 'date';
                    document.getElementById('dateToggle').classList.add('hidden');
                }
            </script>

            @foreach($students as $student)
                <div>
                    
                    <label class="select mb-2">
                        <span class="label w-full p-4">{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}</span>
                        <select name="attendance[{{ $student->id }}]">
                            <option value="present">Present</option>
                            <option value="absent">Absent</option>
                        </select>
                    </label>
                </div>
            @endforeach

            <button class="btn btn-xs btn-secondary text-neutral p-2" type="submit">Save Attendance</button>
        </form>
    </div>
</x-layout>