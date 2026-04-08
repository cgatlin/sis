@props ([
    'studentsCount',
    'coursesCount',
    'teachersCount',
    'presentToday',
    'absentToday',
    'labels',
    'data',
    'semester' => 'All',
    'year' => 'All'
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
            <div>
                <div class="bg-white shadow-md rounded w-90 px-8 p-6 mb-4 mt-2">Total # of Teachers: {{ $teachersCount }}</div>
                <div class="bg-white shadow-md rounded w-90 px-8 p-6 mb-4 mt-2">Total # of Courses: {{ $coursesCount }}</div>
                <div class="bg-white shadow-md rounded w-90 px-8 p-6 mb-4 mt-2">Total # of Students: {{ $studentsCount }}</div>
            </div>

            <div>
                <div class="bg-white shadow-md rounded w-90 px-8 p-6 mb-4 mt-2">Total # of Students Present on {{ now()->toDateString() }}: {{ $presentToday }}</div>
                <div class="bg-white shadow-md rounded w-90 px-8 p-6 mb-4 mt-2">Total # of Students Absent on {{ now()->toDateString() }}: {{ $absentToday }}</div>
            </div>
        </div>


        <a class="btn btn-xs btn-info" href="/dashboard/export">Export Course Count</a>

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

        <!-- Charts Row -->
        <div class="grid grid-cols-2 gap-10">

            <!-- Bar Chart -->
            <div class="col-md-6">
                <div class="card p-3">
                    <h6 class="text-center">Students per Course</h6>
                    <canvas id="studentsPerCourseChart"></canvas>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-md-6">
                <div class="card p-3">
                    <h6 class="text-center">Enrollment Distribution</h6>
                    <canvas id="enrollmentPieChart"></canvas>
                </div>
            </div>

        </div>

        <script>
            const labels = @json($labels);
            const data = @json($data);

            // Bar Chart
            new Chart(document.getElementById('studentsPerCourseChart'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Students',
                        data: data
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    }
                }
            });

            // Pie Chart
            new Chart(document.getElementById('enrollmentPieChart'), {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data
                    }]
                },
                options: {
                    responsive: true
                }
            });
        </script>

    </div>
</x-layout>