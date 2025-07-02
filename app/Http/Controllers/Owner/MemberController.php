<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    // Add / Register a new member
    public function addMember(Request $request)
    {
        
        $data = $request->validate([
            'm_name' => '',
            'm_age' => 'required|integer|min:0|max:120',
            'm_weight' => 'required|integer|min:0|max:500',
            'm_height' => 'required|integer|min:0|max:300',
            'm_phone' => 'required|string|max:15|unique:members',
            'm_email' => 'required|string|max:255|unique:members',
            'm_password' => 'required|string|min:6|max:255',
            'm_flag' => 'required|integer|in:0,1', // 0 for inactive, 1 for active
            'p_id' => 'required|exists:purchases,p_id',
            'c_id' => 'required|exists:cashes,c_id',
            'm_amount' => 'required|integer|min:0',
            'm_expiry_date' => 'required|date',
        ]);
        $member = \App\Models\Member::create($data);
        return response()->json([
            'message' => 'Member added successfully',
            'member' => $member
        ], 201);
    }

    // Purchase a membership
    public function purchaseMembership(Request $request)
    {
        $data = $request->validate([
            'm_id' => 'required|exists:members,m_id',
            'p_id' => 'required|exists:purchases,p_id',
            'c_id' => 'required|exists:cashes,c_id',
            'm_amount' => 'required|integer|min:0',
            'm_expiry_date' => 'required|date',
        ]);
        $member = \App\Models\Member::findOrFail($data['m_id']);
        $member->p_id = $data['p_id'];
        $member->c_id = $data['c_id'];
        $member->m_amount = $data['m_amount'];
        $member->m_expiry_date = $data['m_expiry_date'];
        $member->save();        
        return response()->json([
            'message' => 'Membership purchased successfully',
            'member' => $member
        ], 200);
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

}
