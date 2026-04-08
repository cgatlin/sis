@props ([
    'courses' => [],
    'semester' => 'All',
    'year' => 'All'
])

<x-layout title='FIT - Courses List'>
    <div class="bg-secondary p-4">
        <h1 class="text-xl">List of Courses</h1>
            @if (auth()->user()->role === 'admin')
                <a class="btn btn-xs btn-accent text-neutral" href="/courses/create">Create New Course</a>
            @endif
    </div>

    <div class="p-2">
        <form class="" method="GET">
            <label class="text-gray-700 text-sm font-bold mb-2" for="semester">Semester:
                <select class="select shadow bg-primary w-30" name="semester" id="semester">
                    <option value="All" @selected(old('semester', $semester) == 'All')>All</option>
                    <option value="Spring" @selected(old('semester', $semester) == 'Spring')>Spring</option>
                    <option value="Summer" @selected(old('semester', $semester) == 'Summer')>Summer</option>
                    <option value="Fall" @selected(old('semester', $semester) == 'Fall')>Fall</option>
                    <option value="Winter" @selected(old('semester', $semester) == 'Winter')>Winter</option>
                </select>
            </label>
            <label class="text-gray-700 text-sm font-bold mb-2" for="year">Year:
                <input class="input shadow bg-primary w-30" type="int" name="year" value="{{ $year }}">
            </label>
            <button class="btn btn-xs btn-accent text-neutral" type="submit">Filter</button>
        </form>
    </div>

    <ul class="list rounded-box shadow-md flex items-center justify-center">
    @foreach ($courses as $course)
        <li class="list-row shadow">
            <a href="/courses/{{ $course->id }}">{{ $course->course_code }}, {{ $course->course_name }} - {{ $course->semester }}: {{ $course->year }}</a>
        </li>
    @endforeach
    </ul>

</x-layout>