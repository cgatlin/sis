@props ([
    'course',
    'students'
])
<x-layout title='FIT - Enroll Students to Course'>
<div>
    <div class="bg-secondary p-4">
        <h1>
            <div class="link uppercase"><a href="/courses/{{ $course->id }}">{{ $course->course_code }} - {{ $course->course_name }}</a></div>
            <div>{{ $course->semester }} - {{ $course->year }}</div>
            <div>Teacher: {{ $course->user->name }}</div>
        </h1>
    </div>
   

    <form class="bg-white shadow-md rounded px-8 pt-4 pb-4 mb-2 mt-2" action="/courses/{{ $course->id }}/enroll-student" method="POST" id="enroll_form">
        @csrf
        <label class="block text-gray-700 text-sm font-bold mb-2" for="students">
            <input class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="student" id="student" list="students" placeholder="Type to enroll student...">
            <datalist id="students">
                @foreach ($students as $student)
                    <option data-id='{{ $student->id }}' value='{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}'>
                @endforeach
            </datalist>
            <button class="btn btn-xs btn-secondary text-neutral pl-2" type="submit">Add Student</button>
        </label>
        @if ($errors->has('student'))
            <div> {{ $errors->first('student') }} </div>
        @endif

        <input type="hidden" name="selected_student" id="selected_student">
        <script>
            document.getElementById('student').addEventListener('input', function(e) {
                var input = e.target;
                var list = input.getAttribute('list');
                var options = document.querySelectorAll('#' + list + ' option');
                var hiddenInput = document.getElementById('selected_student');
                var inputValue = input.value;

                hiddenInput.value = ""; // Reset if no match

                for (var i = 0; i < options.length; i++) {
                    var option = options[i];
                    if (option.value === inputValue) {
                        hiddenInput.value = option.getAttribute('data-id');
                        break;
                    }
                }
            });
        </script>
        
    </form>
    <h1>
        {{ $course->students->count() }} Currently Enrolled Students:
        
    </h1>
    <div class="overflow-x-auto place-items-center justify-center">
        <table class="table table-zebra w-90">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($course->students as $student)
                    <tr>
                        <td>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</td>
                        <td>
                            <form action="/courses/{{ $course->id }}/remove-student/{{ $student->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-xs btn-error" type="submit">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</x-layout>