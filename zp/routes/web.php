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

Route::middleware(['auth'])->group(function () {
    Route::get('/student', [StudentController::class, 'index'])->middleware('role:Student')->name('student');
    Route::get('/teacher', [TeacherController::class, 'index'])->middleware('role:Teacher')->name('teacher');
    Route::post('/teacher', [TeacherController::class, 'store'])->middleware('role:Teacher')->name('teacher.store');
    Route::post('/teacher/upload', [App\Http\Controllers\TeacherController::class, 'upload'])->middleware(['auth', 'teacher'])->name('teacher.upload');
    Route::post('/teacher/upload_image', [App\Http\Controllers\TeacherController::class, 'uploadImage'])->middleware(['auth', 'teacher'])->name('teacher.upload_image');
    Route::delete('/teacher/{id}', [TeacherController::class, 'deleteFile'])->middleware('role:Teacher')->name('teacher.delete');
    Route::delete('/teacher/image/{id}', [TeacherController::class, 'deleteImage'])->middleware('role:Teacher')->name('teacher.deleteImage');
    Route::get('/teacher/addFiles', [App\Http\Controllers\TeacherController::class, 'addFiles'])->middleware(['auth', 'teacher'])->name('teacher.addFiles');

});
