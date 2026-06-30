<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\ServiceGroupController;
use App\Http\Controllers\Api\VisitController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\PreparationController;
use App\Http\Controllers\Api\SpiritualTaskController;

use App\Http\Controllers\Api\AdminDashboardController;

Route::post('/login', [AuthController::class, 'login']); 

Route::apiResource('users', UserController::class);

Route::apiResource('members', MemberController::class);

Route::apiResource('service-groups', ServiceGroupController::class);

Route::apiResource('visits', VisitController::class);

Route::apiResource('attendances', AttendanceController::class);

Route::apiResource('announcements', AnnouncementController::class);

Route::apiResource('preparations',PreparationController::class);

Route::apiResource('spiritual-tasks',SpiritualTaskController::class);


Route::get(
    '/admin/dashboard',
    [AdminDashboardController::class, 'index']
);