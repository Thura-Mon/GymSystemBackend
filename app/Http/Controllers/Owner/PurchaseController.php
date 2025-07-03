<?php
namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function viewPurchase(Request $request)
    {
        $planCategory = $request->input('category');
        $purchases = \App\Models\Purchase::where('p_id', $planCategory)->first();

        if ($planCategory == 1 || $planCategory == 2 || $planCategory == 3) {
            
            return response()->json(['purchases' => $purchases], 200);
        }
      
    }
}
