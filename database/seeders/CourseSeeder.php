<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $baseCourses = [
            [
                'course_code' => 'CS101',
                'course_name' => 'Intro to Programming',
                'description' => 'covers the fundamental concepts, logic, and tools used to create software, websites, and applications. It focuses on writing algorithms (step-by-step instructions), understanding syntax, and using core programming concepts—such as variables, loops, and control structures—to solve problems, rather than mastering a specific language.',
            ],
            [
                'course_code' => 'CS201',
                'course_name' => 'Data Structures',
                'description' => 'a core computer science course that focuses on the efficient organization, management, and storage of data to enable fast access and modification.'
            ],
            [
                'course_code' => 'IT101',
                'course_name' => 'Networking Basics',
                'description' => 'covers fundamental concepts for connecting devices to share resources and information. Key topics include Local Area Networks (LANs) vs. Wide Area Networks (WANs), network components (routers, switches, NICs), TCP/IP protocols, IP addressing, and basic troubleshooting, often focusing on enabling network communication and Internet access.'
            ],
            [
                'course_code' => 'CYB101',
                'course_name' => 'Intro to Cybersecurity',
                'description' => 'a foundational course covering key concepts of digital protection, including the CIA triad (confidentiality, integrity, availability), threat identification, and risk management. It prepares students to understand malware, phishing, and network security basics, often through practical, hands-on exercises, simulations, or case studies.'
            ],
            [
                'course_code' => 'MATH101',
                'course_name' => 'College Algebra',
                'description' => 'covers foundational algebraic techniques, focusing on solving equations, simplifying expressions, and understanding functions'
                ],
            [
                'course_code' => 'BUS101',
                'course_name' => 'Intro to Business',
                'description' => 'a foundational survey course covering key business principles, including marketing, finance, management, operations, and ethics'
                ],
        ];

        $semesters = ['Spring','Fall'];
        $years = [2024, 2025, 2026];

        $course = [];

        foreach ($years as $year) {
            foreach ($semesters as $semester) {
                foreach ($baseCourses as $course) { 
                    $courses[] = [
                        'course_code' => $course['course_code'],
                        'course_name' => $course['course_name'],
                        'description' => $course['description'],
                        'credits' => rand(3, 5),
                        'semester' => $semester,
                        'year' => $year,
                        'User' => rand(2, 27),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        DB::table('courses')->insert($courses);
    }
}