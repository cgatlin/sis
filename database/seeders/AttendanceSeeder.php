<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {

        $enrollments = DB::table('enrollments')->get();

        foreach ($enrollments as $enrollment) {

            $dates = collect();

            while ($dates->count() < 10) {
                $date = Carbon::now()->subDays(rand(1, 30))->toDateString();
                $dates->push($date);
                $dates = $dates->unique(); 
            }

            foreach ($dates as $date) {
                DB::table('attendances')->insert([
                    'student_id' => $enrollment->student_id,
                    'course_id' => $enrollment->course_id,
                    'attendance_date' => $date,
                    'status' => collect(['present', 'absent'])->random(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}