<?php

namespace App\Http\Controllers\Member;

use App\Models\Bmi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BMIController extends Controller
{
    public function store(Request $request){
    $validated = $request->validate([
        'm_id' => 'required',
        'bmi_status' => 'required',
        'bmi_result' => 'required|integer',
    ]);

    $bmi = Bmi::create($validated);

    return response()->json([
        'message' => 'BMI record created successfully',
        'data' => $bmi
    ]);
}

}
