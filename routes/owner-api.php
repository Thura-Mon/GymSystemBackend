<?php

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\AuthController;
use App\Http\Controllers\Owner\MemberController;

Route::post('/login',[AuthController::class, 'login'])->middleware(); // Admin Authentication

Route::post('/total-members', [MemberController::class, 'totalMembers']); // Total members count

Route::post('/total-active-members', [MemberController::class, 'totalActiveMembers']); // Total active members count

Route::post('/total-inactive-members', [MemberController::class, 'totalInactiveMembers']); // Total inactive members count




// Route::get('/insert-seller', function () {
//     $seller = \App\Models\Seller::create([
//         'name' => 'John Supabase',
//         'password' => 'password123',
//     ]);

//     return response()->json($seller);
// });

Route::get('/sellers', function () {

    $sellers = \App\Models\Seller::first();

    return response()->json([
        'sellers' => $sellers->name
    ]);
});



Route::get('/', function (Request $request) {

    $username = 'gymadmin';
    $password = 'password123';
    if (!$username || !$password) {
        return response()->json(['message' => 'Username and password are required'], 400);
    }
    $seller = \App\Models\Seller::where('name', $username)
        ->first();

    if (Hash::check($password, $seller->password)) {
        return response()->json(['message' => 'Seller is valid'], 200);
    }

    return response()->json(['message' => 'Invalid seller credentials'], 401);
});





