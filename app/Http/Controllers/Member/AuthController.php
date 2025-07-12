<?php

namespace App\Http\Controllers\Member;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function viewPassword(Request $request)
    {
        $email = $request->input('m_email');


        if (!$email) {
        return response()->json(['message' => 'Email is required'], 400);
        }

        $password = \App\Models\Member::where('m_email', $email)->value('m_password');

        if($password){
            return response()->json(['password' => $password]);
        }

    }
}
