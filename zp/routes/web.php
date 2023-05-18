<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SubmitSolutionController;
use App\Http\Controllers\ManualController;

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
Route::get('/manual', [ManualController::class, 'show']);
Route::get('/manual/pdf', [ManualController::class, 'generatePDF'])->name('manual.pdf');

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
    Route::post('/teacher/toggle-publish/{id}', [TeacherController::class, 'togglePublish'])->middleware('role:Teacher')->name('teacher.togglePublish');
    Route::post('/teacher/setPublishDate/{id}', [TeacherController::class, 'setPublishDate'])->name('teacher.setPublishDate');
    Route::post('/student/start-exam', [StudentController::class, 'startExam'])->middleware('role:Student')->name('student.startExam');
    Route::get('/student/exam', [StudentController::class, 'showExam'])->middleware('role:Student')->name('student.exam');
    //Route::get('lang/home', [LocalizationController::class, 'index']);
    //Route::get('lang/change', [LocalizationController::class, 'change'])->name('changeLang');
    Route::post('/exam/submit', [SubmitSolutionController::class, 'submitSolution'])->name('exam.submit');
    Route::post('/change-language', 'LocalizationController@changeLanguage')->name('changeLanguage');

});
