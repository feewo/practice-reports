<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GroupController;

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/check-token', [AuthController::class, 'checkToken'])->middleware('auth:sanctum');
Route::get('/groups', [GroupController::class, 'index']);

// Маршруты доступные только преподавателям
Route::middleware(['auth:sanctum', 'ability:teacher'])->group(function () {
    Route::get('/teacher/students-reports', [TeacherController::class, 'getStudentsReports']);
    Route::post('/grades/set', [GradeController::class, 'setGrade']);
    Route::put('/grades/{id}', [GradeController::class, 'updateGrade']);
    Route::delete('/grades/{id}', [GradeController::class, 'deleteGrade']);
    
    // Дополнительные маршруты для учителей
    Route::get('/teacher/dashboard', [TeacherController::class, 'getDashboard']);
    Route::get('/teacher/courses', [TeacherController::class, 'getCourses']);
});

// Маршруты доступные всем аутентифицированным пользователям
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/reports/upload', [ReportController::class, 'uploadReport']);
    Route::get('/student/reports', [StudentController::class, 'getMyReports']);
});