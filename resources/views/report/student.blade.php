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
            </h1>
        </div>
    </div>


    <div class="overflow-x-auto place-items-center justify-center">
        <table class="table table-zebra w-90">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Grade</th>
                </tr>
            </thead>

            <tbody>
                @foreach($course->students as $student)
                    <tr>
                        <td>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</td>
                        <td>
                            {{ $student->grade ?? 'Grade not recieved' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-layout>