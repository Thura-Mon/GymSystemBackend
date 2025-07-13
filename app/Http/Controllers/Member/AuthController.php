<?php

namespace App\Http\Controllers\Member;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function viewPassword(Request $request)
    {
        $email = $request->input('m_email');


        if (!$email) {
        return response()->json(['message' => 'Email is required'], 400);
        }

        $check = \App\Models\Member::where('m_email', $email)->first();

        if(!$check){
            return response()->json(['message' => 'Unauthorized Access']);
        }

        return response()->json(['Email : ' => $email]);

    }

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