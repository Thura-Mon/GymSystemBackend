<?php

use App\Http\Controllers\Owner\AccountController;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\AuthController;
use App\Http\Controllers\Owner\CashController;
use App\Http\Controllers\Owner\MemberController;
use App\Http\Controllers\Owner\PurchaseController;
use Illuminate\Support\Facades\Mail;

Route::post('/login',[AuthController::class, 'login'])->middleware(); // Admin Authentication

Route::post('/add-members', [MemberController::class, 'addMember']); // Add / Register a new member

Route::post('/get-members', [MemberController::class, 'getAllMembers']); // Update member details

Route::post('/total-members', [MemberController::class, 'totalMembers']); // Total members count

Route::post('/total-active-members', [MemberController::class, 'totalActiveMembers']); // Total active members count

Route::post('/total-inactive-members', [MemberController::class, 'totalInactiveMembers']); // Total inactive members count

Route::post('/purchase-plans', [PurchaseController::class, 'viewPurchase']); // Purchase Plan

Route::post('/get-cash', [CashController::class, 'getCash']); // Get cash transactions

Route::post('/cash-transaction', [AccountController::class, 'cash_transaction']);

Route::get('/sellers', function () {

    $sellers = \App\Models\Seller::first();

    return response()->json([
        'sellers' => $sellers->name
    ]);
});



Route::get('/', function (Request $request) {

    echo "Welcome Seller";


});

Route::get('/verify-otp', function (Request $request) {

    $otp = rand(100000, 999999);
    Mail::to('thuramon086@gmail.com')->send(
        new \App\Mail\VerifyOTP($otp));
    return view('emails.verify_otp',['otp' => $otp]);
    });


