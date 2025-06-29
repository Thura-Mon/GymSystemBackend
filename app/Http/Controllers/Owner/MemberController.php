<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    // Total members count
    public function totalMembers(Response $response)
    {
        $totalMembers = \App\Models\member::count();

        return response()->json([
            'total_members' => $totalMembers
        ]);
    }


    // Total members count with active status (m_flag = 0 or)
    public function totalActiveMembers(Response $response)
    {
        $totalActiveMembers = \App\Models\member::where('m_flag', 0)->count();
        return response()->json([
            'total_active_members' => $totalActiveMembers
        ]);         

    }

}
