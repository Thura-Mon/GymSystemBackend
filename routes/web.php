<?php

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

Route::get('/test-email', function () {
    Mail::raw('This is a test email from Laravel SMTP setup.', function ($message) {
        $message->to('thuramon086@gmail.com')
                ->subject('Test Email');
    });

    return 'Email Sent!';
});



// Route::get('/', function (Request $request) {

//     $username = 'gymadmin';
//     $password = 'password123';
//     if (!$username || !$password) {
//         return response()->json(['message' => 'Username and password are required'], 400);
//     }
//     $seller = \App\Models\Seller::where('name', $username)
//         ->first();

//     if (Hash::check($password, $seller->password)) {
//         return response()->json(['message' => 'Seller is valid'], 200);
//     }

//     return response()->json(['message' => 'Invalid seller credentials'], 401);
// });



Route::get('/', function () {
    return view('hello'); // This will show hello.blade.php
});