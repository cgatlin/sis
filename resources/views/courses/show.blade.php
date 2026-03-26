@props ([
    'course',
    'students'
])
<x-layout title='FIT - Course Details'>
<div>
    <h1>{{ $course->course_code }} - {{ $course->course_name }}</h1>
    <div>
        <span>{{ $course->semester }} - {{ $course->year }}: {{ $course->credits }} Credits</span>
    </div>
    <div>{{ $course->user->name }}</div>
    <h1>Description:</h1>
    <div>{{ $course->description }}</div>

    <h1>Currently Enrolled Students:
        <form action="/courses/{{ $course->id }}/enroll-student" method="POST" id="enroll_form">
            @csrf
            <label for="teacher">Enroll Student:</label>
            <input type="text" name="student" id="student" list="students" placeholder="Type to search...">
            <datalist id="students">
                @foreach ($students as $student)
                    <option data-id='{{ $student->id }}' value='{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}'>
                @endforeach
            </datalist>

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
            <button type="submit">Add Student</button>
        </form>
    </h1>
    @foreach ($course->students as $student )
        <div>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}
            <form action="/courses/{{ $course->id }}/remove-student/{{ $student->id }}" method="POST">
                @csrf
                <button type="submit">Remove Student</button>
            </form>
        </div>
    @endforeach

</div>

<div>
    <a href="/courses/{{ $course->id }}/edit">Edit</a>

    <form action="/courses/{{ $course->id }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')

        <button type="submit">Delete</button>
    </form>
</div>

</x-layout>