<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Enums\UserRole;
use App\Http\Controllers\DeliveryJobController;

Route::post('/login', [UserController::class, 'login']);


// Admin routes
Route::middleware(['auth:sanctum', 'role:' . UserRole::ADMIN->value])->group(function () {
    Route::get('/delivery-jobs-list', [DeliveryJobController::class, 'listJobs']);
    Route::get('/drivers-list', [UserController::class, 'listDrivers']);
    Route::post('/create-job', [DeliveryJobController::class, 'createDeliveryJob']);
    Route::patch('/update-job/{jobId}', [DeliveryJobController::class, 'updateDeliveryJob']);
    Route::patch('/assign-driver', [DeliveryJobController::class, 'assignDriver']);
});
