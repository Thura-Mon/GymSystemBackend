<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\AuthController;
use App\Http\Controllers\Member\MemberController;

Route::post('/login', [AuthController::class, 'login'])->middleware();

Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

Route::post('/check-otp', [AuthController::class, 'checkOtp']);

Route::post('/change-password', [AuthController::class, 'changePassword']);

Route::post('/scan-qr', [MemberController::class, 'qrScanner']); // Scan Qr

Route::post('/get-user', [MemberController::class, 'getUser']); // Get User

Route::post('/get-member-image', [MemberController::class, 'memberImage']); // Get uploaded Image

Route::post('/renew-plan', [MemberController::class, 'renewPlanByUser']); // Plan Renew

Route::post('/get-member-status', [MemberController::class, 'getMemberStatus']); // Inactive Member

Route::post('/profile-info', [MemberController::class, 'profileInfo']); // Profile Information