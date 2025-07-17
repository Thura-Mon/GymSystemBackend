<?php

namespace App\Http\Controllers\Owner;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\CashTransactionInformation;

class AccountController extends Controller
{
    public function cash_transaction(Request $request)
    {
        $date = $request->input('i_date', Carbon::now());
        $fromtype = $request->input('fromtype');
        $totype = $request->input('totype');
        $tranamount = $request->input('amount');
        $note=$request->input('note', '');

        if (!$date || !$fromtype || !$totype || !$tranamount) {
            return response()->json(['message' => 'Input required'], 400);
        }

        // Get current totals
        $fromTotal = \App\Models\CashTransaction::where('ct_type', $fromtype)->sum('ct_total');
        $toTotal = \App\Models\CashTransaction::where('ct_type', $totype)->sum('ct_total');

        // Subtract and add the amount
        $updatedFromTotal = $fromTotal - $tranamount;
        $updatedToTotal = $toTotal + $tranamount;

        // Optional: prevent negative values
        if ($updatedFromTotal < 0) {
            return response()->json(['message' => 'Insufficient funds in fromtype'], 400);
        }

        // Update both ct_type totals
        \App\Models\CashTransaction::where('ct_type', $fromtype)->update([
            'ct_total' => $updatedFromTotal,
        ]);

        \App\Models\CashTransaction::where('ct_type', $totype)->update([
            'ct_total' => $updatedToTotal,
        ]);
        CashTransactionInformation::create([
            'i_date' => $date,
            'fromtype' => $fromtype, // Negative for deduction
            'totype' => $totype, 
            'amount' => $tranamount,
            'note' => $note,
        ]);

        return response()->json([
            'message' => 'Transaction successful',
            'fromtype_total' => $updatedFromTotal,
            'totype_total' => $updatedToTotal,
            'amount' => $tranamount
        ], 200);
    }

    public function totalTransaction(Request $request){

        $totalamount = \App\Models\CashTransaction::sum('ct_total');

        if($totalamount){
            return response()->json(['Total Amount' => $totalamount]);
        }
    }

    public function getTransactionInfo(Request $request){

       $info = CashTransactionInformation::all();


        if($info){
            return response()->json(['INFO' => $info], 200);
        }

        else{
            return response()->json(['message' => 'Info Not Found'], 404);
        }
    }
}
