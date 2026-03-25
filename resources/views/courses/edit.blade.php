@props([
    'course',
    'teachers'
])

<x-layout title='FIT - Course Edit'>

<div>
    <h1>Create New Course</h1>

    <form action='/courses/{{ $course->id }}' method="POST" id="course_form">
        @csrf

        @method("PATCH")

        <div>
            <label for="course_code">Course Code:</label>
            <input type="text" id="course_code" name="course_code" required value='{{ $course->course_code }}'>
            @if ($errors->has('course_code'))
                <div> {{ $errors->first('course_code') }} </div>
            @endif
        </div>

        <div>
            <label for="course_name">Course Name:</label>
            <input type="text" id="course_name" name="course_name" required value='{{ $course->course_name }}'>
            @if ($errors->has('course_name'))
                <div> {{ $errors->first('course_name') }} </div>
            @endif
        </div>

        <div>
            <label for="semester">Semester:</label>
            <select name="semester" id="semester">
                <option value="Spring" @selected(old('semester', $course->semester) == 'Spring')>Spring</option>
                <option value="Summer" @selected(old('semester', $course->semester) == 'Summer')>Summer</option>
                <option value="Fall" @selected(old('semester', $course->semester) == 'Fall')>Fall</option>
                <option value="Winter" @selected(old('semester', $course->semester) == 'Winter')>Winter</option>
            </select>
            @if ($errors->has('semester'))
                <div> {{ $errors->first('semester') }} </div>
            @endif
        </div>

        <div>
            <label for="year">Year:</label>
            <input type="text" id="year" name="year" required value='{{ $course->year }}'>
            @if ($errors->has('year'))
                <div> {{ $errors->first('year') }} </div>
            @endif
        </div>

        <div>
            <label for="credits">Credits:</label>
            <input type="number" id="credits" name="credits" required value='{{ $course->credits }}'>
            @if ($errors->has('credits'))
                <div> {{ $errors->first('credits') }} </div>
            @endif
        </div>

        <div>
            <label for="teacher">Teacher:</label>
            <input type="text" name="teacher" id="teacher" list="teachers" value="{{ old('teacher', $course->user->name ?? '') }}" placeholder="Type to search...">
            <datalist id="teachers">
                @foreach ($teachers as $teacher)
                    <option data-id='{{ $teacher->id }}' value='{{ $teacher->name }}'>
                @endforeach
            </datalist>

            @if ($errors->has('user'))
                <div> {{ $errors->first('user') }} </div>
            @endif

            <input type="hidden" name="user" id="user" value="{{ old('user', $course->user->id ?? '') }}">
            <script>
                document.getElementById('teacher').addEventListener('input', function(e) {
                    var input = e.target;
                    var list = input.getAttribute('list');
                    var options = document.querySelectorAll('#' + list + ' option');
                    var hiddenInput = document.getElementById('user');
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
        </div>

        <div>
            <label for="description">Description:</label>
            {{-- <input type="text" id="description" name="description" required> --}}
            <textarea form ="course_form" name="description" id="taid" cols="35" wrap="soft">{{ $course->description }}</textarea>
            @if ($errors->has('description'))
                <div> {{ $errors->first('description') }} </div>
            @endif
        </div>
       
        <button type="submit">Save Edit</button>
    </form>
</div>

</x-layout>
   