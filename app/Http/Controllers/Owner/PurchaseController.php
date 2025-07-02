<?php
namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function viewPurchase(Request $request)
    {
        $planCategory = $request->input('category');
       

        if (in_array($planCategory, [1, 2, 3])) {
            return response()->json(['message' => 'success'],200);
            
        }

        // Fetch purchases with that plan category (e.g., p_month)
      
    }
}
