<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\AuthController;

Route::post('/login', [AuthController::class, 'login'])->middleware();

Route::get('/verify-otp',[AuthController::class,'verifyOtp']);