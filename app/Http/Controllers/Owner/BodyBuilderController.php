<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
        $id = $request->input('b_id');
        $trainer = \App\Models\Member::where('b_id', $id)->first();
        if (!$trainer) {
            return response()->json([
                'error' => 'trainer not found.'
            ], 404);
        }
         DB::beginTransaction();
        try {
    
        $trainer->b_name = $request->input('b_name', $trainer->b_name);
        $trainer->b_phone = $request->input('b_phone',$trainer->b_phone);
        $trainer->b_description = $request->input('b_description', $trainer->b_description);
        $trainer->b_dob = $request->input('b_dob', $trainer->b_dob);
        $trainer->b_nrc = $request->input('b_nrc', $trainer->b_nrc);
        $trainer->b_address = $request->input('b_address', $trainer->b_address);
        $trainer->b_image = $request->input('b_image', $trainer->b_image);
        $trainer->b_cretificate = $request->input('b_certificate', $trainer->b_cretificate);

         $trainer->save();

            DB::commit();

            return response()->json([
                'message' => 'Body Builder updated successfully',
                'Trainer' => $trainer
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Error updating body builder: ' . $e->getMessage()
            ], 500);
        }
    }

    // Retrieve / Get bodybuilder
    public function getbodybuilder(Request $request){
         $bodyBuilder = \App\Models\BodyBuilder::all();
    

        return response()->json([
            'id' => $bodyBuilder->pluck('b_id')->toArray(),
            'name' => $bodyBuilder->pluck('b_name')->toArray(),
            'description' => $bodyBuilder->pluck('b_description')->toArray(),
            'phone' => $bodyBuilder->pluck('b_phone')->toArray(),
            'dob' => $bodyBuilder->pluck('b_dob'),
            'nrc' => $bodyBuilder->pluck('b_nrc')->toArray(),
            'image' => $bodyBuilder->pluck('b_image')->toArray(),
            'address' => $bodyBuilder->pluck('b_address')->toArray(),
            'certificate' => $bodyBuilder->pluck(('b_certificate'))->toArray()
        ]);
    }
}


