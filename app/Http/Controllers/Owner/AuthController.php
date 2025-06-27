<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    $username = 'gymadmin';
    $password = 'password123'; // Replace with your actual password

    if (!$username || !$password) {
      return response()->json(['message' => 'Username and password are required'], 400);
    }
    


    
    $seller = \App\Models\Seller::where('name', $username)
      ->first();

    if ($seller && Hash::check($password, $seller->password)) {
      return response()->json(['message' => 'Login successful', 'seller' => $seller], 200);
    }

    return response()->json(['message' => 'Invalid credentials'], 401);
  }
}
