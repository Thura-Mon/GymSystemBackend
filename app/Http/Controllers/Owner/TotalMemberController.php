<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TotalMemberController extends Controller
{
    public function totalMembers(Request $request)
    {
        $totalMembers = \App\Models\member::count();

        return response()->json([
            'total_members' => $totalMembers
        ]);
    }
}
