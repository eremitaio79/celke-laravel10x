<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Original project route.
/* Route::get('/', function () {
    return view('welcome');
}); */

// Homepage project route.
Route::get('/', function () {
    return view('homecelke');
});

// Courses.
Route::get('/index-course', [CourseController::class, 'index'])->name('course.index'); // Index method.
Route::get('/show-course/{id?}', [CourseController::class, 'show'])->name('course.show'); // Show method.
Route::get('/create-couse', [CourseController::class, 'create'])->name('course.create'); // Create method.
Route::post('/store-course', [CourseController::class, 'store'])->name('course.store'); // Store method.
Route::get('/edit-course/{id?}', [CourseController::class, 'edit'])->name('course.edit'); // Edit method.
Route::put('/update-course', [CourseController::class, 'update'])->name('course.update'); // Put method.
Route::delete('/destroy-course', [CourseController::class, 'destroy'])->name('course.destroy'); // Delete method.
