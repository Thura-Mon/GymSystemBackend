<?php

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;



Route::get('/', function () {
    return view('welcome'); // This will show hello.blade.php
});