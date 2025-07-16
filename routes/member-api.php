<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\AuthController;

Route::post('/login', [AuthController::class, 'login'])->middleware();

Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

Route::post('/check-otp', [AuthController::class, 'checkOtp']);
