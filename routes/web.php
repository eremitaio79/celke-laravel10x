<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
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
    return view('login.index');
})->name('root');


/* My routes ------------------------------------------------------------------------------------ */

/* PUBLIC ROUTES */
// -------------------------------------------------------------------------------------------------
// Authentication.
Route::post('/process-login', [LoginController::class, 'loginProcess'])->name('login.process'); // Login.

// Routes for users without registration on the course platform.
Route::get('/create-user-login', [LoginController::class, 'createUser'])->name('user.login.create');
Route::post('/store-user-login', [LoginController::class, 'storeUser'])->name('user.login.store');

// Password Recovery.
Route::get('/recovery-profile', [ProfileController::class, 'passwordRecovery'])->name('profile.recovery');
Route::post('/recovery-profile', [ProfileController::class, 'passwordRecoverySubmit'])->name('profile.recovery.submit');
Route::get('/recovery-reset', [ProfileController::class, 'index'])->name('password.reset');
Route::get('/password-reset/{token}', [ProfileController::class, 'showResetPassword'])->name('password.reseting');
Route::post('/password-reset', [ProfileController::class, 'submitResetPassword'])->name('password.reseting.submit');


/* PRIVATE ROUTES */
// -------------------------------------------------------------------------------------------------
// Route group to check permissions to access the views below.
// These are restricted routes that rely on user authentication.
Route::group(['middleware' => 'auth'], function () {
    // Homepage after authentication.
    Route::get('/home', [LoginController::class, 'home'])->name('home');

    // Logout route.
    Route::get('/process-logout', [LoginController::class, 'logoutProcess'])->name('logout.process'); // Logout.

    // Courses.
    Route::get('/index-course', [CourseController::class, 'index'])->name('course.index'); // Index course method.
    Route::get('/show-course/{id}', [CourseController::class, 'show'])->name('course.show'); // Show course method.
    Route::get('/create-course', [CourseController::class, 'create'])->name('course.create'); // Create course method.
    Route::post('/store-course', [CourseController::class, 'store'])->name('course.store'); // Store course method.
    Route::get('/edit-course/{id}', [CourseController::class, 'edit'])->name('course.edit'); // Edit course method.
    Route::put('/update-course/{id}', [CourseController::class, 'update'])->name('course.update'); // Put course method.
    Route::delete('/destroy-course/{id}', [CourseController::class, 'destroy'])->name('course.destroy'); // Delete course method.

    // Classes.
    Route::get('/index-allclasse', [ClasseController::class, 'allClasses'])->name('allclasse.index'); // Index all classes method.
    Route::get('/index-classe/{course}', [ClasseController::class, 'index'])->name('classe.index'); // Index classe method.
    Route::get('/show-classe/{id}', [ClasseController::class, 'show'])->name('classe.show'); // Show classe method.
    Route::get('/create-classe/{course}', [ClasseController::class, 'create'])->name('classe.create'); // Create classe method.
    Route::post('/store-classe', [ClasseController::class, 'store'])->name('classe.store'); // Store classe method.
    Route::get('/edit-classe/{id}', [ClasseController::class, 'edit'])->name('classe.edit'); // Edit classe method.
    Route::put('/update-classe/{id}', [ClasseController::class, 'update'])->name('classe.update'); // Update classe method.
    Route::delete('/destroy-classe/{classe}', [ClasseController::class, 'destroy'])->name('classe.destroy'); // Delete classe method.

    // Users.
    Route::get('/index-user', [UserController::class, 'index'])->name('user.index'); // Index user method.
    Route::get('/show-user/{id}', [UserController::class, 'show'])->name('user.show'); // Show user method.
    Route::get('/create-user', [UserController::class, 'create'])->name('user.create'); // Create user method.
    Route::post('/store-user', [UserController::class, 'store'])->name('user.store'); // Store user method.
    Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('user.edit'); // Edit user method.
    Route::put('/update-user/{id}', [UserController::class, 'update'])->name('user.update'); // Update user method.
    Route::delete('/destroy-user/{id}', [UserController::class, 'destroy'])->name('user.destroy'); // Destroy user method.
    Route::get('/edit-user-password/{id}', [UserController::class, 'passwordEdit'])->name('user.password-edit'); // Edit password user method.
    Route::put('/update-user-password/{id}', [UserController::class, 'passwordUpdate'])->name('user.password-update'); // Update password user method.

    // Connected User Profile.
    Route::get('/show-profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/edit-profile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/update-profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/edit-password-profile/{id}', [ProfileController::class, 'passwordEdit'])->name('profile.password.edit');
    Route::put('/update-password-profile/{id}', [ProfileController::class, 'passwordUpdate'])->name('profile.password.update');
    Route::delete('/destroy-profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User levels.
    Route::get('/index-role', [RoleController::class, 'index'])->name('role.index');

    // Permissions role level.
    Route::get('index-role-permission/{role}', [RolePermissionController::class, 'index'])->name('role.permission.index');
});
