<?php

namespace App\Http\Controllers\Member;

use App\Models\Cash;
use App\Models\Member;
use App\Models\MemberDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\CashTransaction;
use App\Http\Controllers\Controller;
use App\Models\Purchase;

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

// Member Image
public function memberImage(Request $request){
        $id = $request->input('id');

        if(!$id){
            return response()->json(['message' => "Invalid ID"]);
        }
        $memberDay = MemberDay::where('m_id', $id)->first();
        
        if($memberDay){
            return response()->json(['message' => $memberDay]);
        }
    }

    // Renew plan By user

    public function renewPlanByUser(Request $request)
    {
    // Validate inputs
    $validated = $request->validate([
        'm_email'   => 'required|email',
        'p_id'      => 'required|integer',
        'c_type'    => 'required|string',
        'c_amount'  => 'required'
    ]);

    // Clean and convert c_amount to integer
    $c_amount_raw = $validated['c_amount'];
    $c_amount = intval(preg_replace('/[^0-9]/', '', $c_amount_raw));

    // Re-check if c_amount is now valid
    if ($c_amount <= 0) {
        return response()->json(['message' => 'Invalid cash amount'], 400);
    }

    // Retrieve member by email
    $member = Member::where('m_email', $validated['m_email'])->first();
    if (!$member) {
        return response()->json(['message' => 'Member not found'], 404);
    }

    // Retrieve cash type info
    $type = CashTransaction::where('ct_type', $validated['c_type'])->first();
    if (!$type) {
        return response()->json(['message' => 'Invalid cash type'], 400);
    }

    $plan = Purchase::where('p_id', $validated['p_id'])->first();
    if (!$plan) {
        return response()->json(['message' => 'Invalid plan ID'], 400);
    }
    // Insert into cashes table
    $cash = Cash::create([
        'c_amount'  => $c_amount,
        'c_type'    => $validated['c_type'],
        'c_flag'    => $type->c_flag,
        'c_note'    => 'Renew month ( '.$plan->p_month.' ) with amount'.$plan->p_amount.' for member: ' . $member->m_name,
        'c_date'    => Carbon::now()->toDateString(),
        'm_id'      => $member->m_id,
        
    ]);

    // Update member's plan ID
    $member->p_id = $validated['p_id'];

    // If m_reg_date is today or in the future, set m_reg_date to today

    $today = Carbon::now()->toDateString();
    if (Carbon::parse($member->m_reg_date)->gte(Carbon::now()->startOfDay())) {
        $member->m_reg_date = $today;
    }

    // Extend expiry date based on plan
    switch ((int)$validated['p_id']) {
        case 1:
            $daysToAdd = 30;
            break;
        case 2:
            $daysToAdd = 60;
            break;
        case 3:
            $daysToAdd = 90;
            break;
        default:
            $daysToAdd = 0;
            break;
    }

    if ($daysToAdd > 0) {
        $currentExpiry = $member->m_expiry_date ? Carbon::parse($member->m_expiry_date) : Carbon::now();
        $member->m_reg_date = Carbon::now(); // Set reg_date to current expiry date
        $member->m_expiry_date = $currentExpiry->copy()->addDays($daysToAdd)->toDateString();
    }

    $member->save();
    
    // $member->p_id = $validated['p_id'];
    // $member->save();

    // Update total in cash_transactions
    $currentAmount = $type->ct_total;
    $newAmount = $currentAmount + $c_amount;

    $type->update(['ct_total' => $newAmount]);

    // update today_days of MemberDay

    $mid = Member::where('m_email',$validated['m_email'])->value('m_id');

    $day = MemberDay::where('m_id', $mid)->value('today_days');


    if($day){
        MemberDay::update([
            'today_days'=>$day->addDays($daysToAdd)
        ]);
    }

    return response()->json([
        'message' => 'Plan renewed successfully',
        'cash_id' => $cash->c_id
    ], 200);

    
}

}
