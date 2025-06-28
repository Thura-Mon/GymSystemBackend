<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TotalMemberController extends Controller
{
    // Total members count
    public function totalMembers(Request $request)
    {
        $totalMembers = \App\Models\member::count();

        return response()->json([
            'total_members' => $totalMembers
        ]);
    }


    // Total members count with active status (m_flag = 0 or)
    public function totalActiveMembers(Request $request)
    {
        $totalActiveMembers = \App\Models\member::where('m_flag', 0)->count();
        return response()->json([
            'total_active_members' => $totalActiveMembers
        ]);         

    }

}
