<img src="docs/images/logo.png" width="150" alt="Fantasy Institute of Technology Logo">
**Fantasy Institute of Technology**
Student Information System

Portfolio Project – Backend Development

A web-based Student Information System (SIS) designed for the fictional Fantasy Institute of Technology, a community college used as a development environment for practicing backend architecture, database design, and administrative tools.

This project simulates common features found in real educational management systems, including student enrollment, course management, grade tracking, and faculty administration.

## Features

Student profile management

Instructor and staff management

Course and department management

Class enrollment system

Attendance tracking

Gradebook system

Administrative dashboard

Role-based authentication (Admin / Faculty / Student)


## Roadmap

Planned features:

- [x] Student CRUD system
- [x] Instructor/Staff management
- [x] Course enrollment
- [ ] Gradebook module
- [ ] Transcript generation
- [ ] GPA calculator
- [ ] API endpoints



**Project Purpose**

This project was created as a portfolio piece to demonstrate:

Laravel application architecture

relational database design

CRUD system development

role-based authentication

administrative dashboard development

The fictional Fantasy Institute of Technology environment allows the system to simulate real-world educational administration workflows.

## Dashboard

<img src="docs/images/dashboard-1.png" alt="Dashboard Screenshot 1">

<img src="docs/images/dashboard-2.png" alt="Dashboard Screenshot 2">

## Student Management
Paginated List of Students with searching functionality.
<img src="docs/images/student-1.png" alt="Student Screenshot 1">
View Student info including the current Courses enrolled in.
<img src="docs/images/student-2.png" alt="Student Screenshot 2">
Ability to Enroll and Remove from Courses.
<img src="docs/images/student-3.png" alt="Student Screenshot 2">

## Course Management
Listing of All Courses with Semester and Year filtering.
<img src="docs/images/course-1.png" alt="Course Screenshot 1">
Info of the Course including list of Students enrolled.
Options to take Attendance, view all/previous Attendances, and Reports for Students and Attendance.
<img src="docs/images/course-2.png" alt="Course Screenshot 2">
View the Creatation of a Course.
<img src="docs/images/course-3.png" alt="Course Screenshot 3">
From Course info able to enroll or remove Students.
<img src="docs/images/course-4.png" alt="Course Screenshot 4">

# Installation

## 1. Clone Repository

```bash
git clone https://github.com/cgatlin/sis.git
cd fit-student-system
```
## 2.Install Dependencies

```bash
composer install
npm install
```
## 3. Create Enviroment

```bash
cp .env.example .env
php artisan key:generate
```
## Database Setup (if NOT using sqlite)

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fit_student_system
DB_USERNAME=root
DB_PASSWORD=
```
## Migration and Seeding

```bash
php artisan migrate:fresh --seed
```
## Build FrontEnd Assests

```bash
npm run build
```
## Start Server

```bash
php artisan serve
```
Application will run at:
http://127.0.0.1:8000

## Demo Login Credentials

Admin:
- webmaster@fit.edu
- 12345678

Teacher:
- vfrizzle@fit.edu
- 12345678