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
        'bmi_result' => 'required',
    ]);

    $bmi = Bmi::create($validated);

    return response()->json([
        'message' => 'BMI record created successfully',
        'data' => $bmi
    ]);
}

// BMI History

public function bmiHistory(Request $request)
{
    $id = $request->input('id');

    if (!$id) {
        return response()->json(['message' => 'Invalid ID'], 400);
    }

    $history = Bmi::where('m_id', $id)->first();

    if (!$history) {
        return response()->json(['message' => 'No History Found'], 404);
    }

    return response()->json([
        'bmi_status' => $history->bmi_status,
        'bmi_result' => $history->bmi_result,
        'created_at' => $history->created_at,
    ]);
}


}
