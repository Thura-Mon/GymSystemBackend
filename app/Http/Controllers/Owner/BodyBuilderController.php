<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BodyBuilderController extends Controller
{
   public function insertbodybuilder(Request $request)
    {
        $b_name = $request->input('b_name');
        $b_phone = $request->input('b_phone');
        $b_description = $request->input('b_description');
        $b_dob = $request->input('b_dob');
        $b_nrc= $request->input('b_nrc');
        $b_address = $request->input('b_address');
        $b_image = $request->input('b_image', '');
        $b_certificate = $request->input('b_certificate', '');

        if (!$b_name || !$b_description || !$b_phone || !$b_image || !$b_certificate) {
            return response()->json(['message' => 'Input required'], 400);
        }

        \App\Models\BodyBuilder::create([
            'b_name' => $b_name,
            'b_phone' => $b_phone,
            'b_description' => $b_description,
            'b_dob' => $b_dob,
            'b_nrc' => $b_nrc,
            'b_address' => $b_address,
            'b_image' => $b_image,
            'b_certificate' => $b_certificate,
        ]);

        return response()->json(['message' => 'Bodybuilder created successfully'], 201);
    }





    # Delete bodybuilder

    public function deletebodybuilder(Request $request)
    {
        $b_id = $request->input('b_id');

        if (!$b_id) {
            return response()->json(['message' => 'Bodybuilder ID required'], 400);
        }

        $bodybuilder = \App\Models\BodyBuilder::find($b_id);

        if (!$bodybuilder) {
            return response()->json(['message' => 'Bodybuilder not found'], 404);
        }

        $bodybuilder->delete();

        return response()->json(['message' => 'Bodybuilder deleted successfully'], 200);
    }




    
    # Update bodybuilder's all data check with b_id

    public function updatebodybuilder(Request $request)
    {
    
        $b_name = $request->input('b_name');
        $b_phone = $request->input('b_phone');
        $b_description = $request->input('b_description');
        $b_dob = $request->input('b_dob');
        $b_nrc= $request->input('b_nrc');
        $b_address = $request->input('b_address');
        $b_image = $request->input('b_image');
        $b_cretificate = $request->input('b_certificate');

        if (!$b_name || !$b_description || !$b_phone || !$b_image || !$b_cretificate) {
            return response()->json(['message' => 'Input required'], 400);
        }

        $bodybuilder = \App\Models\BodyBuilder::find($b_nrc);

        if (!$bodybuilder) {
            return response()->json(['message' => 'Bodybuilder not found'], 404);
        }

        // Update the bodybuilder
        $bodybuilder->update([
            'b_name' => $b_name,
            'b_phone' => $b_phone,
            'b_description' => $b_description,
            'b_dob' => $b_dob,
            'b_nrc' => $b_nrc,
            'b_address' => $b_address,
            'b_image' => $b_image,
            'b_cretificate' => $b_cretificate,
        ]);

        return response()->json(['message' => 'Bodybuilder updated successfully'], 200);
    }
}
