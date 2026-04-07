@props ([
    'course',
    'students'
])
<x-layout title='FIT - Course Details'>
<div>
    <div class="bg-secondary p-4">
        <h1>
            <span class="uppercase">
                {{ $course->course_code }} - {{ $course->course_name }}
            </span>
            <div>
                <a class="btn btn-xs btn-accent" href="/courses/{{ $course->id }}/edit">Edit</a>

                <form action="/courses/{{ $course->id }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-xs btn-error" type="submit">Delete</button>
                </form>
            </div>
        </h1>
    </div>
    <div class="bg-white shadow-md rounded px-8 pb-4 pt-2 mb-2">

        <div class="flex justify-center gap-2">
            <a class="btn btn-xs btn-info" href="/courses/{{ $course->id }}/attendance/create">Take Attendance</a>
            <a class="btn btn-xs btn-info" href="/courses/{{ $course->id }}/attendance">View Attendance by Date</a>
    
            <a class="shadow btn btn-xs btn-info" href="/courses/{{ $course->id }}/report/student">Student Report</a>
            <a class="shadow btn btn-xs btn-info" href="/courses/{{ $course->id }}/report/attendance">Attendance Report</a>
        </div>

        <div>
            <span>{{ $course->semester }} - {{ $course->year }}: {{ $course->credits }} Credits</span>
        </div>
        <div>Teacher: {{ $course->user->name }}</div>
        <h1>Description:</h1>
        <div>{{ $course->description }}</div>
    </div>
    <h1>
        {{ $course->students->count() }} Currently Enrolled Students:
        <a class="btn btn-xs btn-soft btn-secondary" href="/courses/{{ $course->id }}/enroll-student">Enroll Students</a>
        <a class="btn btn-xs btn-info" href="/courses/{{ $course->id }}/export-student">Export Student List</a>
    </h1>
    <div class="overflow-x-auto place-items-center justify-center">
        <table class="table table-zebra w-90">
            <thead>
                <tr>
                    <th>Name</th>
                </tr>
            </thead>

            <tbody>
                @foreach($course->students as $student)
                    <tr>
                        <td>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



</x-layout>