<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\AuthController;

Route::post('/view-password', [AuthController::class, 'viewPassword'])->middleware();

Route::get('/verify-otp',[AuthController::class,'verifyOtp']);