<?php

use App\Http\Controllers\ClasseController;
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
// Welcome view is created by default in a new Laravel project.
/* Route::get('/', function () {
    return view('welcome');
}); */

// Homepage project route.
Route::get('/', function () {
    return view('homecelke');
});

/* My routes */

// Courses.
Route::get('/index-course', [CourseController::class, 'index'])->name('course.index'); // Index method.
Route::get('/show-course/{id}', [CourseController::class, 'show'])->name('course.show'); // Show method.
Route::get('/create-course', [CourseController::class, 'create'])->name('course.create'); // Create method.
Route::post('/store-course', [CourseController::class, 'store'])->name('course.store'); // Store method.
Route::get('/edit-course/{id}', [CourseController::class, 'edit'])->name('course.edit'); // Edit method.
Route::put('/update-course/{id}', [CourseController::class, 'update'])->name('course.update'); // Put method.
Route::delete('/destroy-course/{id}', [CourseController::class, 'destroy'])->name('course.destroy'); // Delete method.

// Classes.
Route::get('/index-allclasse', [ClasseController::class, 'allClasses'])->name('allclasse.index'); // Index all classes method.
Route::get('/index-classe/{course}', [ClasseController::class, 'index'])->name('classe.index'); // Index classe method.
Route::get('/show-classe/{id}', [ClasseController::class, 'show'])->name('classe.show'); // Show classe method.
Route::get('/create-classe/{course}', [ClasseController::class, 'create'])->name('classe.create'); // Create classe method.
Route::post('/store-classe', [ClasseController::class, 'store'])->name('classe.store'); // Store classe method.
Route::get('/edit-classe/{id}', [ClasseController::class, 'edit'])->name('classe.edit'); // Edit classe method.
Route::put('/update-classe/{id}', [ClasseController::class, 'update'])->name('classe.update'); // Update classe method.
