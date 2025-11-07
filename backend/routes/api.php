<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Enums\UserRole;
use App\Http\Controllers\DeliveryJobController;

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);


// Admin routes
Route::middleware(['auth:sanctum', 'role:' . UserRole::ADMIN->value])->group(function () {
    Route::get('/delivery-jobs-list', [DeliveryJobController::class, 'listAllJobs']);
    Route::get('/drivers-list', [UserController::class, 'listDrivers']);
    Route::post('/create-job', [DeliveryJobController::class, 'createDeliveryJob']);
    Route::patch('/update-job/{jobId}', [DeliveryJobController::class, 'updateDeliveryJob']);
    Route::delete('/delete-job/{jobId}', [DeliveryJobController::class, 'deleteJob']);
    Route::patch('/assign-driver', [DeliveryJobController::class, 'assignDriver']);
});

// Driver routes
Route::middleware(['auth:sanctum', 'role:' . UserRole::DRIVER->value])->group(function () {
    Route::get('/driver-jobs-list/{driverId}', [DeliveryJobController::class, 'listDriverJobs']);
    Route::patch('/update-delivery-status', [DeliveryJobController::class, 'updateDeliveryStatus']);
});
