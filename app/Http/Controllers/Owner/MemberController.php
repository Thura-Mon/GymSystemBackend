<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
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
