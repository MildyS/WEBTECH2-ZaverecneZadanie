<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [RegisterController::class, 'showRegistrationForm'])->name('register');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/student', [StudentController::class, 'index'])->middleware('role:Student')->name('student');
    Route::get('/teacher', [TeacherController::class, 'index'])->middleware('role:Teacher')->name('teacher');
});
