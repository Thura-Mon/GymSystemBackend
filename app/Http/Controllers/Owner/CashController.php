<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CashController extends Controller
{    
    public function getCash(Request $request){
        $cash = \App\Models\CashTransaction::all();
        if($cash){
            return response()->json([
                    'message' => $cash,
                ], 200);
        }
    }
}
