<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\AuthController;
use App\Http\Controllers\Member\BMIController;
use App\Http\Controllers\Member\Builder;
use App\Http\Controllers\Member\MemberController;
use App\Models\BodyBuilder;

Route::post('/login', [AuthController::class, 'login'])->middleware();

Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

Route::post('/check-otp', [AuthController::class, 'checkOtp']);

Route::post('/change-password', [AuthController::class, 'changePassword']); // change forgot password

Route::post('/update-password', [AuthController::class, 'changeUserPasswordAfterLogin']); // Update password

Route::post('/scan-qr', [MemberController::class, 'qrScanner']); // Scan Qr

Route::post('/get-user', [MemberController::class, 'getUser']); // Get User

Route::post('/get-member-image', [MemberController::class, 'memberImage']); // Get uploaded Image

Route::post('/renew-plan', [MemberController::class, 'renewPlanByUser']); // Plan Renew

Route::post('/get-member-status', [MemberController::class, 'getMemberStatus']); // Inactive Member

Route::post('/profile-info', [MemberController::class, 'profileInfo']); // Profile Information

Route::post('/update-profile-info', [MemberController::class, 'updateInfo']); // Update Profile

Route::post('/upload-profile-image', [MemberController::class, 'editProfile']); // Update Profile Image

Route::post('/create-Bmi', [BMIController::class, 'store']); // create BMI record

Route::post('/rate-builder', [Builder::class, 'assignRating']); // Rate with stars

Route::post('/get-all-rating', [Builder::class, 'getRatings']); // Get Rating

Route::post('/rating-button', [Builder::class, 'displayRatingButton']); // Check and display

Route::post('/member-noti', [Builder::class, 'notifyMemberStatusByEmail']); // Notificatiion
