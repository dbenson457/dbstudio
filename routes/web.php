<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('videos',\App\Http\Controllers\VideoController::class);
Route::get('add-video/{id}',[\App\Http\Controllers\VideoController::class, 'addVideo'])->name('add-video');
Route::resource('courses',\App\Http\Controllers\CourseController::class);
Route::get('courses/filter/{filter}',[\App\Http\Controllers\CourseController::class, 'filter'])->name('courses/filter');
Route::get('search/find/{filter}',[\App\Http\Controllers\CourseController::class, 'filterFind'])->name('search');
Route::get('search', [\App\Http\Controllers\CourseController::class, 'findCourses'])->name('search');
Route::resource('userCourses',\App\Http\Controllers\UserCourseController::class);
Route::get('course/{name}',[\App\Http\Controllers\UserCourseController::class, 'store'])->name('courses');
Route::resource('userVideos',\App\Http\Controllers\UserVideoController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
