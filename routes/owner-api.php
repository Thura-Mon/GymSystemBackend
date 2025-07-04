<?php

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\AuthController;
use App\Http\Controllers\Owner\MemberController;
use App\Http\Controllers\Owner\PurchaseController;

Route::post('/login',[AuthController::class, 'login'])->middleware(); // Admin Authentication

Route::post('/add-members', [MemberController::class, 'addMember']); // Add / Register a new member

Route::post('/total-members', [MemberController::class, 'totalMembers']); // Total members count

Route::post('/total-active-members', [MemberController::class, 'totalActiveMembers']); // Total active members count

Route::post('/total-inactive-members', [MemberController::class, 'totalInactiveMembers']); // Total inactive members count

Route::post('/purchase-plans', [PurchaseController::class, 'viewPurchase']); // Purchase Plan

Route::get('/sellers', function () {

    $sellers = \App\Models\Seller::first();

    return response()->json([
        'sellers' => $sellers->name
    ]);
});



Route::get('/', function (Request $request) {

    echo "Welcome Seller";


});





