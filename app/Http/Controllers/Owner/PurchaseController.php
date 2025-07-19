<?php
namespace App\Http\Controllers\Owner;

use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseController extends Controller
{
    public function viewPurchase(Request $request)
    {
        $planCategory = $request->input('category');
        $purchases = \App\Models\Purchase::where('p_id', $planCategory)->get();

        if (in_array($planCategory, [1, 2, 3])) {
            
            return response()->json([
            'message' => 'Successful',
            'purchases' => $purchases], 200);
        }
      
    }

    // Update Package Plan Amount

    public function updatePlanAmount(Request $request)
{
    $id = $request->input('p_id');
    $amount = $request->input('p_amount');

    if (!$id) {
        return response()->json(['message' => 'Invalid Package Type'], 400);
    }

    $package = Purchase::where('p_id', $id)->first();

    if (!$package) {
        return response()->json(['message' => 'Package not found'], 404);
    }

    $package->p_amount = $amount;
    $package->save();

    return response()->json(['message' => 'Package amount updated successfully'], 200);
}

}
