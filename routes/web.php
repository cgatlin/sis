<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('home'));

Route::middleware('auth')->group(function () {
    Route::get('/students', [StudentController::class, 'index']);
    Route::get('/students/create', [StudentController::class, 'create']);
    Route::post('/students', [StudentController::class, 'store']);
    Route::get('/students/{student}', [StudentController::class, 'show']);
    Route::get('/students/{student}/edit', [StudentController::class, 'edit']);
    Route::patch('/students/{student}', [StudentController::class, 'update']);
    Route::delete('/students/{student}', [StudentController::class, 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/create', [CourseController::class, 'create']);
    Route::post('/courses', [CourseController::class, 'store']);
    Route::get('/courses/{course}', [CourseController::class, 'show']);
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit']);
    Route::patch('/courses/{course}', [CourseController::class, 'update']);
    Route::post('/courses/{course}/enroll-student', [CourseController::class, 'enrollStudent']);
    Route::post('/courses/{course}/remove-student/{student}', [CourseController::class, 'removeStudent']);
    Route::delete('/courses/{course}', [CourseController::class, 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/staff', [UserController::class, 'index']);
    Route::get('/staff/create', [UserController::class, 'create']);
    Route::post('/staff', [UserController::class, 'store']);
    Route::get('/staff/{user}', [UserController::class, 'show']);
    Route::get('/staff/{user}/edit', [UserController::class, 'edit']);
    Route::patch('/staff/{user}', [UserController::class, 'update']);
    Route::delete('/staff/{user}', [UserController::class, 'destroy']);
});

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::delete('/logout', [SessionController::class, 'destroy']);
