<?php

namespace App\Http\Controllers\Owner;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use \App\Models\Member;
use Carbon\Carbon;

class MemberController extends Controller
{

    // Add / Register a new member
    public function addMember(Request $request)
{

DB::beginTransaction();


    try {
        // Create Member
        
            $mName = $request->input('m_name');
            $mAge = $request->input('m_age');
            $mWeight = $request->input('m_weight');
            $mHeight = $request->input('m_height');
            $mPhone = $request->input('m_phone');
            $mEmail = $request->input('m_email');
            $mPassword = $request->input('m_password');
            $mFlag = $request->input('m_flag', 1); // 1 for active
            $pId = $request->input('p_id'); // purchaes ID
            $mRegDate = now();
            $mExpDate = null;

            // Calculate expiry date
            if($pId == '1'){
                $mExpDate = $mRegDate->copy()->addDays(30); // 1 month
            } elseif($pId == '2') {
                $mExpDate = $mRegDate->copy()->addDays(60);  // 2 months
            } elseif($pId == '3') {
                $mExpDate = $mRegDate->copy()->addDays(90);  // 3 months
            } else {
                return response()->json([
                    'error' => 'Invalid purchase ID.'
                ], 400);
            }
            
            // Check if the email already existed
            if(Member::where('m_email', $mEmail)->exists()){
                return response()->json([
                    'error' => 'Email Already exists.'
                ], 400);
            }


             // Create Member record
            $member = \App\Models\Member::create([
            'm_name' => $mName,
            'm_age' => $mAge,
            'm_weight' => $mWeight,
            'm_height' => $mHeight,
            'm_phone' => $mPhone,
            'm_email' => $mEmail,
            'm_password' => $mPassword, // Hash the password // AutoGenerate password
            'm_flag' => $mFlag,
            'p_id' => $pId,
            'm_reg_date' => $mRegDate,
            'm_expiry_date' => $mExpDate,
        ]);     
        

        // Determine c_flag based on c_type
        $cashType = $request->input('c_type');
        $cFlag = match ($cashType) {
            'Kpay' => 1,
            'CB' => 2,
            'Cash' => 3,
            default => throw new \Exception('Invalid cash type'),
        };

        // Retrieve the purchase amount based on p_id
        $purchaseAmount = \App\Models\Purchase::where('p_id', $pId)->value('p_amount');

        
        // Create Cash record
        $cash = \App\Models\Cash::create([
            'c_amount' => $purchaseAmount,
            'c_type' => $cashType,
            'c_flag' => $cFlag,
            'c_note' => $request->input('c_note', default: ''),
            'm_id' => $member->m_id, // Associate with the member
            'c_date' => now(),

        ]);


        
        // Create Cash Transaction record
        $initAmount = \App\Models\CashTransaction::where('ct_type', $cashType)->value('ct_total');
        $finalTotalAmount = $initAmount + $cash->c_amount;

        \App\Models\CashTransaction::where('ct_type', $cashType)->update([
            'ct_total' => $finalTotalAmount
        ]); 

        DB::commit();

        return response()->json([
            'message' => 'Member and Cash record created successfully',
            'member' => $member,
            'cash' => $cash,
            'total_amount' => $finalTotalAmount,
        ], 201);

    } catch (\Exception $e) {

        return response()->json([
            'message' => 'Error occurred',
            'error' => $e->getMessage()
        ], 500);
    }
}



    // Total members count
    public function totalMembers(Request $request)
    {
        $totalMembers = \App\Models\Member::count();

        return response()->json([
            'total_members' => $totalMembers
        ]);
    }


    // Total members count with active status (m_flag = 1)
    public function totalActiveMembers(Request $request)
    {
        $totalActiveMembers = \App\Models\Member::where('m_flag', 1)->count();
        return response()->json([
            'total_active_members' => $totalActiveMembers
        ]);         

    }

    // Total members count with inactive status (m_flag = 0)
    public function totalInactiveMembers(Request $request)
    {
        $totalInactiveMembers = \App\Models\Member::where('m_flag', 0)->count();
        return response()->json([
            'total_inactive_members' => $totalInactiveMembers
        ]);     
    }

    // Total members count with expired status (m_flag = 2)
    public function totalExpMembers(Request $request)
    {
        $totalExpMembers = \App\Models\Member::where('m_flag', 2)->count();
        return response()->json([
            'total_inactive_members' => $totalExpMembers
        ]);     
    }

    // Get all members
    public function memberAndCash(Request $request)
    {
        $members = \App\Models\Member::all();
        $cash = \App\Models\Cash::all();

        return response()->json([
            'id' => $cash->pluck('m_id')->toArray(),
            'date' => $cash->pluck('c_date')->toArray(),
            'name' => $members->pluck('m_name')->toArray(),
            'phone' => $members->pluck('m_phone')->toArray(),
            'email' => $members->pluck('m_email')->toArray(),
            'cash' => $cash->pluck('c_amount')->toArray(),
            'cash_type' => $cash->pluck('c_type')->toArray(),
            'age' => $members->pluck('m_age')->toArray(),
            'weight' => $members->pluck('m_weight')->toArray(),
            'height' => $members->pluck('m_height')->toArray(),
        ]);
    }

    // Update member details
    public function updateMember(Request $request){
        $id = $request->input('m_id');
        $member = \App\Models\Member::where('m_id', $id)->first();
        if (!$member) {
            return response()->json([
                'error' => 'Member not found.'
            ], 404);
        }
        DB::beginTransaction();
        try {
            // Update member details
            $member->m_name = $request->input('m_name', $member->m_name);
            $member->m_phone = $request->input('m_phone', $member->m_phone);
            $member->m_age = $request->input('m_age', $member->m_age);
            $member->m_email = $request->input('m_email', $member->m_email);
            $member->m_weight = $request->input('m_weight', $member->m_weight);
            $member->m_height = $request->input('m_height', $member->m_height);
            
            $member->save();

            DB::commit();

            return response()->json([
                'message' => 'Member updated successfully',
                'member' => $member
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Error updating member: ' . $e->getMessage()
            ], 500);
        }
    }




    // Delete Member
    public function deleteMember(Request $request){
        $requestMail = $request->input('m_email');
        $member = \App\Models\Member::where('m_email', $requestMail)->delete();
        if (!$member) {
            return response()->json([
                'error' => 'Member not found.'
            ], 404);
        }
    }


// Get Member with Active Status

    public function getActiveMember(Request $request)
    {
        $members = \App\Models\Member::where('m_flag', 1)->get();


        return response()->json([
            'message' => $members
        ]);
    }
}