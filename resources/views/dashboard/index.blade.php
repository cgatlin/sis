@props ([
    'studentsCount',
    'coursesCount',
    'teachersCount',
    'presentToday',
    'absentToday'
])

<x-layout title='FIT - DashBoard'>
    <div>
        <div class="bg-secondary p-4">
            <h1>
                <span class="uppercase">
                    DashBoard
                </span>
            </h1>
        </div>

        <div class="place-items-center justify-center bg-gray-100">
            <div class="bg-white shadow-md rounded w-90 px-8 p-6 mb-4 mt-2">
                <div>Total # of Teachers: {{ $teachersCount }}</div>
                <div>Total # of Courses: {{ $coursesCount }}</div>
                <div>Total # of Students: {{ $studentsCount }}</div>
            </div>

            <div class="bg-white shadow-md rounded w-90 px-8 p-6 mb-4 mt-2">
                <div>Total # of Students Present on {{ now()->toDateString() }}: {{ $presentToday }}</div>
                <div>Total # of Students Absent on {{ now()->toDateString() }}: {{ $absentToday }}</div>
            </div>
        </div>



    </div>
</x-layout>