<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseVideoController;
use App\Http\Controllers\PixController;
use App\Http\Controllers\UserCourseHistoryController;

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

Route::post('/googlelogin', [GoogleAuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    // Routes for User model
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);

    // Routes for CourseVideo model
    Route::get('/course_videos', [CourseVideoController::class, 'index']);
    Route::post('/course_videos', [CourseVideoController::class, 'store']);
    Route::get('/course_videos/{course_video}', [CourseVideoController::class, 'show']);
    Route::put('/course_videos/{course_video}', [CourseVideoController::class, 'update']);
    Route::delete('/course_videos/{course_video}', [CourseVideoController::class, 'destroy']);

    // Routes for Pix model
    Route::get('/pixes', [PixController::class, 'index']);
    Route::post('/pixes', [PixController::class, 'store']);
    Route::get('/pixes/{pix}', [PixController::class, 'show']);
    Route::put('/pixes/{pix}', [PixController::class, 'update']);
    Route::delete('/pixes/{pix}', [PixController::class, 'destroy']);

    // Routes for UserCourseHistory model
    Route::get('/user_course_histories', [UserCourseHistoryController::class, 'index']);
    Route::post('/user_course_histories', [UserCourseHistoryController::class, 'store']);
    Route::get('/user_course_histories/{user_course_history}', [UserCourseHistoryController::class, 'show']);
    Route::put('/user_course_histories/{user_course_history}', [UserCourseHistoryController::class, 'update']);
    Route::delete('/user_course_histories/{user_course_history}', [UserCourseHistoryController::class, 'destroy']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});