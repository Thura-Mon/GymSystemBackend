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

    // Get all records where m_id = $id
    $history = Bmi::where('m_id', $id)->get();

    if ($history->isEmpty()) {
        return response()->json(['message' => 'No History Found'], 404);
    }

    // Return all records as an array of bmi_status, bmi_result, created_at
    return response()->json([
        'history' => $history->map(function ($record) {
            return [
                'bmi_status' => $record->bmi_status,
                'bmi_result' => $record->bmi_result,
                'created_at' => $record->created_at,
            ];
        })
    ]);
}



}
