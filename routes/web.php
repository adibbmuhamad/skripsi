<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\HealthReportController;

Route::get('/', function () {
    return redirect('/admin/login');
});

//api serach by nisn
Route::get('api/attendance/history/{nisn}', [AttendanceController::class, 'getAttendanceHistory']);
Route::get('api/achievement/history/{nisn}', [AchievementController::class, 'getAchievementByNisn']);
Route::get('api/health-report/history/{nisn}', [HealthReportController::class, 'getHealthReportByNisn']);
Route::get('api/violation/history/{nisn}', [ViolationController::class, 'getViolationByNisn']);
