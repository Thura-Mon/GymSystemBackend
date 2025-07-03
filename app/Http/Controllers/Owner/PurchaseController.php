<?php
namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function viewPurchase(Request $request)
    {
        $planCategory = $request->input('category');
        $purchases = \App\Models\Purchase::where('p_month', $planCategory)->first();

        if (in_array($planCategory, [1, 2, 3])) {
            
            return response()->json([
                'message' => 'Success',
                'purchases' => $purchases
            ])->setStatusCode(200);
        }
      
    }
}
