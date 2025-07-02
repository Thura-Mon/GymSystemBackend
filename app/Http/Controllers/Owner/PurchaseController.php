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
        $purchases = \App\Models\Purchase::where('p_month', $planCategory)->get();

        return response()->json([
            'message' => 'success',
            'data' => $purchases
        ], 200);
    }

    return response()->json(['error' => 'Invalid category selected'], 400);
}

}
