<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentEnrollmentController;
use App\Http\Controllers\CourseEnrollmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Display all students
Route::get('/students', [StudentController::class, 'index']);

// Enroll student in a course
Route::post('/enrollment', [StudentEnrollmentController::class, 'enroll']);

// Retrieve course data
Route::get('/courses', [CourseController::class, 'index']);

Route::post('/courses/{course}/enrollWithCourse', [CourseEnrollmentController::class, 'enrollWithCourse']);


