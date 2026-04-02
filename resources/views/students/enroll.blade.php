@props ([
    'courses',
    'student'
])
<x-layout title='FIT - Enroll Student to Courses'>
<div>
    <div class="bg-secondary p-4">
        <h1>
            <div class="link uppercase"><a href="/students/{{ $student->id }}">{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }} </a></div>
        </h1>
    </div>
   

    <form class="bg-white shadow-md rounded px-8 pt-4 pb-4 mb-2 mt-2" action="/students/{{ $student->id }}/enroll-course" method="POST" id="enroll_form">
        @csrf
        <label class="block text-gray-700 text-sm font-bold mb-2" for="students">
            <input class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="course" id="course" list="courses" placeholder="Type to enroll in courses...">
            <datalist id="courses">
                @foreach ($courses as $course)
                    <option data-id='{{ $course->id }}' value='{{ $course->course_code }} - {{ $course->course_name }}: {{ $course->semester }} {{ $course->year }}'>
                @endforeach
            </datalist>
            <button class="btn btn-xs btn-secondary text-neutral pl-2" type="submit">Add Course</button>
        </label>
        @if ($errors->has('course'))
            <div> {{ $errors->first('course') }} </div>
        @endif

        <input type="hidden" name="selected_course" id="selected_course">
        <script>
            document.getElementById('course').addEventListener('input', function(e) {
                var input = e.target;
                var list = input.getAttribute('list');
                var options = document.querySelectorAll('#' + list + ' option');
                var hiddenInput = document.getElementById('selected_course');
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
        {{ $student->courses->count() }} Currently Enrolled Courses:
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
                @foreach($student->courses as $course)
                    <tr>
                        <td>{{ $course->course_code }} - {{ $course->course_name }}: {{ $course->semester }} {{ $course->year }}</td>
                        <td>
                            <form action="/students/{{ $student->id }}/remove-course/{{ $course->id }}" method="POST">
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