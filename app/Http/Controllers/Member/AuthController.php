<?php

namespace App\Http\Controllers\Member;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    // Member Login
    public function login(Request $request)
    {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = Member::where('m_email', $request->email)->first();

    if (!$user) {
        return response()->json(['message' => 'Invalid email'], 401);
    }

    $storedPassword = $user->m_password;

    // Handle default password
    $isDefaultPassword = $storedPassword === '000000' && $request->password === '000000';

    if ($isDefaultPassword || Hash::check($request->password, $storedPassword)) {
        // Create token for this user
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'email' => $user->m_email,
        ], 200);
    }

    return response()->json(['message' => 'Invalid credentials'], 401);
}

    // Change Member's Password
    public function changePassword(Request $request){
        $email = $request->input('email');
        $newPassword = $request->input('password');

        if (!$email || !$newPassword) {
            return response()->json(['message' => 'Email and new password is required'], 400);
        }
        $member = \App\Models\Member::where('m_email', $email)->first();

        if (!$member) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        $member->m_password = Hash::make($newPassword);
        $member->save();

        return response()->json(['message' => 'Password changed successfully']);
    }

    // Verify Member's OTP
    public function verifyOtp(Request $request){
        $email = $request->input('email');

        if(!$email){
            return response()->json(['message' => 'Email is required!']);
        }

        $otp = rand(100000, 999999);
        Mail::to($email)->send(
        new \App\Mail\VerifyOTP($otp));
        return view('emails.verify_otp',['otp' => $otp]);
    }

}

