<?php

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

Route::get('/', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');

Route::get('/student', [App\Http\Controllers\StudentController::class, 'index'])->middleware(['auth', 'student'])->name('student.dashboard');
Route::get('/teacher', [App\Http\Controllers\TeacherController::class, 'index'])->middleware(['auth', 'teacher'])->name('teacher.dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/student', function () {
        return view('student');
    })->middleware('role:Student')->name('student');

    Route::get('/teacher', function () {
        return view('teacher');
    })->middleware('role:Teacher')->name('teacher');
});
