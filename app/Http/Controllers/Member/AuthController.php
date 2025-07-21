<?php

namespace App\Http\Controllers\Member;
use App\Models\Member;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;


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
        'id' => $user->m_id,
        'email' => $user->m_email,
        'password' => $user->m_password,
        'phone' => $user->m_phone,
        'name' => $user->m_name, // <-- Add this
        'weight' => $user->m_weight,
        'height' => $user->m_height,
        'flag' => $user->m_flag,
        'purchase' => $user->p_id,
    ], 200);

    }

    return response()->json(['message' => 'Invalid credentials'], 401);
}

    // Change Member's Forgot Password
    public function changePassword(Request $request){
        $email = $request->input('email');
        $newPassword = $request->input('password');

        if (!$email || !$newPassword) {
            return response()->json(['message' => 'New password is required'], 400);
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

public function verifyOtp(Request $request)
{
    $email = $request->input('email');

    if (!$email) {
        return response()->json(['message' => 'Email is required!'], 400);
    }

     // Check if the email exists in your users database table
    $user = Member::where('m_email', $email)->first();
    if (!$user) {
        return response()->json(['message' => 'Email not found!'], 404);
    }

    $otp = rand(100000, 999999);

    // Store OTP in cache for 5 minutes
    Cache::put("otp_$email", $otp, now()->addMinutes(5));

    // Send the OTP via email
    Mail::to($email)->send(new \App\Mail\VerifyOTP($otp));

    return response()->json(['message' => 'OTP sent successfully.'], 200);
}


public function checkOtp(Request $request)
{
    $email = $request->input('email');
    $otp = $request->input('otp');

    if (!$email || !$otp) {
        return response()->json(['message' => 'Email and OTP are required!'], 400);
    }

    $user = Member::where('m_email', $email)->first();
    if (!$user) {
        return response()->json(['message' => 'Email not found!'], 404);
    }

    $cachedOtp = Cache::get("otp_$email");

    if (!$cachedOtp) {
        return response()->json(['message' => 'OTP expired or not found.'], 400);
    }

    if ($otp == $cachedOtp) {
        Cache::forget("otp_$email"); // Invalidate OTP
        return response()->json(['message' => 'OTP verified successfully.'], 200);
    } else {
        return response()->json(['message' => 'Invalid OTP.'], 401);
    }
} 

// Change password by email and password(gmail==>m_email) and update new password

    public function changeUserPasswordAfterLogin(Request $request)
    {
        $m_email = $request->input('m_email');
        $m_oldPassword = $request->input('m_old_password');
        $m_newPassword = $request->input('m_new_password');
        $m_newPasswordConfirmation = $request->input('m_new_password_confirmation');
        if (!$m_email || !$m_oldPassword || !$m_newPassword || !$m_newPasswordConfirmation) {
            return response()->json(['message' => 'Email, old password, new password, and confirmation required'], 400);
        }

        $user = Member::where('m_email', $m_email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Check if current password is hash or plain text
        $isHashed = Str::startsWith($user->m_password, '$2y$');
        if ($isHashed) {
            // Hashed password: use Hash::check
            if (!Hash::check($m_oldPassword, $user->m_password)) {
            return response()->json(['message' => 'Old password is incorrect'], 401);
            }
        } else {
            // Plain text password: direct comparison
            if ($m_oldPassword !== $user->m_password) {
            return response()->json(['message' => 'Old password is incorrect'], 401);
            }
        }
        // Check if new password and confirmation match
        if ($m_newPassword !== $m_newPasswordConfirmation) {
            return response()->json(['message' => 'New password and confirmation do not match'], 400);
        }

        // Update password
        $user->m_password = Hash::make($m_newPassword);
        $user->save();  
        return response()->json(['message' => 'Password updated successfully'], 200);
    
    }
}

