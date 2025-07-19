<?php

namespace App\Http\Controllers\Member;

use App\Models\Member;
use App\Models\MemberDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    // QR Scanner for member check-in
    public function qrScanner(Request $request)
{
    $qrValue = $request->input('qrvalue');

    if (!$qrValue) {
        return response()->json(['message' => 'QR value required'], 400);
    }

    $member = Member::where('m_email', $qrValue)->first();
    if (!$member) {
        return response()->json(['message' => 'Member not found'], 404);
    }

    $memberDays = MemberDay::where('m_id', $member->m_id)->first();
    if (!$memberDays) {
        return response()->json(['message' => 'Member days not found'], 404);
    }

    $today = now()->toDateString();

    // ✅ Prevent double scan in the same day
    if ($memberDays->today_date && Carbon::parse($memberDays->today_date)->isToday()) {
        return response()->json(['message' => 'Already scanned today (' . $today . ')'], 400);
    }

    // ✅ Validate date range
    $regDate = Carbon::parse($member->m_reg_date)->startOfDay();
    $expiryDate = Carbon::parse($member->m_expiry_date)->startOfDay();
    $currentDate = Carbon::now()->startOfDay();

    if ($currentDate->lt($regDate) || $currentDate->gt($expiryDate)) {
        return response()->json(['message' => 'QR check failed: Date not in valid range'], 400);
    }

    // ✅ Reduce one day only if not scanned today
    if ($memberDays->total_days <= 0) {
        return response()->json(['message' => 'No days left for this member'], 400);
    }

    $memberDays->total_days -= 1;
    $memberDays->today_date = $today; // Update scan date
    $memberDays->save();

    return response()->json([
        'status' => true,
        'message' => 'QR check successful for ' . $today
    ], 200);
}

public function getUser(Request $request){
    $useremail = request()->input('email');
    
    if(!$useremail){
        return response()->json(['message' => 'Email Not Found']);
    }

    $getuser = Member::where('m_email', $useremail)->first();

    if(!$useremail){
        return response()->json(['message' => 'No Member Data']);
    }
    return response()->json([
        'member' => $getuser
    ]);
}

}
