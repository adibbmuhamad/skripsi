<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\HealthReportController;
use App\Http\Controllers\StudentDetailController;

Route::get('/', function () {
    return redirect('/admin/login');
});

//api
Route::get('api/attendance/history/{nisn}', [AttendanceController::class, 'getAttendanceHistory']);
Route::get('api/achievement/history/{nisn}', [AchievementController::class, 'getAchievementByNisn']);
Route::get('api/health-report/history/{nisn}', [HealthReportController::class, 'getHealthReportByNisn']);
Route::get('api/violation/history/{nisn}', [ViolationController::class, 'getViolationByNisn']);
Route::get('api/student/{id}/detail', [StudentDetailController::class, 'getStudentDetail']);
Route::get('api/classrooms', [ClassRoomController::class, 'getClassRooms']);
