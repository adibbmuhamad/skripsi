<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AchievementController;

Route::get('/', function () {
    return redirect('/admin/login');
});

//api serach by nisn
Route::get('attendance/history/{nisn}', [AttendanceController::class, 'getAttendanceHistory']);

Route::get('achievement/history/{nisn}', [AchievementController::class, 'getAchievementByNisn']);
