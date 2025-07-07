<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CashController extends Controller
{    public function getCash(Request $request)
    {
        // Retrieve cash transaction details
        $cash = \App\Models\Cash::all();

        return response()->json([
            'cash_transactions' => $cash
        ]);
    }

}
