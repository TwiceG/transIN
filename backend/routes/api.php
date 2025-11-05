<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Enums\UserRole;
use App\Http\Controllers\DeliveryJobController;

Route::post('/login', [UserController::class, 'login']);

Route::middleware(['auth:sanctum', 'role:' . UserRole::ADMIN->value])
    ->get('/delivery-job-list', [DeliveryJobController::class, 'listJobs']);
