@props([
    'course',
    'teachers'
])

<x-layout title='FIT - Course Edit'>

<div class="flex items-center justify-center bg-gray-100">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-2" action='/courses/{{ $course->id }}' method="POST" id="course_form">
        <h1 class="block text-sm font-bold mb-2">Edit Course</h1>
        @csrf

        @method("PATCH")

            <label class="block text-gray-700 text-sm font-bold mb-2" for="course_code">
               <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="course_code" name="course_code" placeholder="Course Code:" required value='{{ $course->course_code }}'>
            </label>
            @if ($errors->has('course_code'))
                <div> {{ $errors->first('course_code') }} </div>
            @endif

            <label class="block text-gray-700 text-sm font-bold mb-2" for="course_name">
               <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="course_name" name="course_name" placeholder="Course Name:" required value='{{ $course->course_name }}'>
            </label>
            @if ($errors->has('course_name'))
                <div> {{ $errors->first('course_name') }} </div>
            @endif

            <label class="block text-gray-700 text-sm font-bold mb-2" for="semester">
                <select class="select shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="semester" id="semester">
                    <option value="Spring" @selected(old('semester', $course->semester) == 'Spring')>Spring</option>
                    <option value="Summer" @selected(old('semester', $course->semester) == 'Summer')>Summer</option>
                    <option value="Fall" @selected(old('semester', $course->semester) == 'Fall')>Fall</option>
                    <option value="Winter" @selected(old('semester', $course->semester) == 'Winter')>Winter</option>
                </select>
            </label>
            @if ($errors->has('semester'))
                <div> {{ $errors->first('semester') }} </div>
            @endif

            <label class="block text-gray-700 text-sm font-bold mb-2" for="year">
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="year" name="year" placeholder="Year:" required value='{{ $course->year }}'>
            </label>
            @if ($errors->has('year'))
                <div> {{ $errors->first('year') }} </div>
            @endif

            <label class="block text-gray-700 text-sm font-bold mb-2" for="credits">
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" id="credits" name="credits" placeholder="Credits:" required value='{{ $course->credits }}'>
            </label>
            @if ($errors->has('credits'))
                <div> {{ $errors->first('credits') }} </div>
            @endif

            <label class="block text-gray-700 text-sm font-bold mb-2" for="teacher">
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="teacher" id="teacher" list="teachers" placeholder="Teacher:" value="{{ old('teacher', $course->user->name ?? '') }}" placeholder="Type to search...">
                <datalist id="teachers">
                    @foreach ($teachers as $teacher)
                        <option data-id='{{ $teacher->id }}' value='{{ $teacher->name }}'>
                    @endforeach
                </datalist>
            </label>
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

            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                <textarea class="textarea shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" form ="course_form" name="description" id="taid" cols="35" wrap="soft" placeholder="Description:">{{ $course->description }}</textarea>     
            </label>
            @if ($errors->has('description'))
                <div> {{ $errors->first('description') }} </div>
            @endif
       
        <button class="btn btn-soft btn-secondary" type="submit">Save Edit</button>
    </form>
</div>

</x-layout>
   