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
        $nowdate = now(); // Get current date in Y-m-d format
        

        //check input date == today_date from member_days table
        $memberDays = MemberDay::where('today_date', $nowdate)->first();

        if ($memberDays || $memberDays->today_date == Carbon::now()->toDate()) {
            return response()->json(['message' => Carbon::now()->toDateString()], 404);
        }


        if (!$qrValue) {
            return response()->json(['message' => 'QR value required'], 400);
        }
        $member =Member::where('m_email', $qrValue)->first();

        if (!$member) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        // Check if the current date is between m_reg_date and m_expiry_date
        $currentDate = Carbon::now()->toDateString();
        $regDate = Carbon::parse($member->m_reg_date)->startOfDay();
        $expiryDate = Carbon::parse($member->m_expiry_date)->startOfDay();
        $inputDate = Carbon::parse($currentDate)->startOfDay();

        if ($inputDate->lt($regDate) || $inputDate->gt($expiryDate)) {
            return response()->json(['message' => 'QR check failed: Date not in valid range'], 400);
        }
        // Reduce one day from member's total days
        $memberDays = MemberDay::where('m_id', $member->m_id)->first();  
        if (!$memberDays) {
            return response()->json(['message' => 'Member days not found'], 404);
        }
        if ($memberDays->total_days <= 0) {
            return response()->json(['message' => 'No days left for this member'], 400);
        }
        $memberDays->total_days -= 1;
        $memberDays->save();

        // update today_date in member_days table
        $memberDays->today_date = $nowdate;
        $memberDays->save();

        return response()->json([
            'status' => true,
            'message' => 'QR check successful'], 200);
        }
}
