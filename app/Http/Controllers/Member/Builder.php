<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\BodyBuilder;
use App\Models\Member;
use App\Models\Rating;
use Illuminate\Http\Request;

class Builder extends Controller
{
    // Assign rating to bodybuilder by member
    public function assignRating(Request $request)
    {
        $m_email = $request->input('m_email');
        $star = $request->input('star');
        $b_id = $request->input('b_id');

        if (!$m_email || !$star || !$b_id) {
            return response()->json(['message' => 'Email, star, and bodybuilder ID required'], 400);
        }

        // Optionally, validate star is between 1 and 5
        if (!is_numeric($star) || $star <= 1 || $star > 5) {
            return response()->json(['message' => 'Star rating must be between 1 and 5'], 400);
        }

        // Optionally, check if member and bodybuilder exist
        $member = Member::where('m_email', $m_email)->first();
        if (!$member) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        // Check if bodybuilder exists
        $bodybuilder = BodyBuilder::find($b_id);
        if (!$bodybuilder) {
            return response()->json(['message' => 'Bodybuilder not found'], 404);
        }

        // Create rating
        Rating::create([
            'm_email' => $m_email,
            'star' => $star,
            'b_id' => $b_id,
        ]);

        return response()->json(['message' => 'Rating assigned successfully'], 201);
}

// Get all ratings and average star is greater than or equal to half of total members*5 output star 5
    public function getRatings(Request $request)
{
    $b_id = $request->input('b_id');

    if (!$b_id) {
        return response()->json(['message' => 'b_id is required'], 400);
    }

    // Get ratings for the given b_id
    $ratings = Rating::where('b_id', $b_id)->get();

    // Count unique members who rated (based on m_id)
    $totalMembers = $ratings->unique('m_id')->count();

    if ($totalMembers === 0) {
        return response()->json(['message' => 'No ratings found for this b_id'], 404);
    }

    $totalStar = $ratings->sum('star');
    $maxPossibleStars = $totalMembers * 5;
    $averageStar = $totalStar / $totalMembers;

    // Define rating level thresholds
    if ($totalStar >= 250) {
        $ratingLevel = 5;
    } elseif ($totalStar >= 200) {
        $ratingLevel = 4;
    } elseif ($totalStar >= 150) {
        $ratingLevel = 3;
    } elseif ($totalStar >= 100) {
        $ratingLevel = 2;
    } elseif ($totalStar > 0) {
        $ratingLevel = 1;
    } else {
        $ratingLevel = 0;
    }

    // Return appropriate response
    if ($ratingLevel >= 1) {
        return response()->json([
            'message' => 'Rating star is sufficient',
            'b_id' => $b_id,
            'rating_level' => $ratingLevel
        ], 200);
    } 
    else {
        return response()->json([
            'message' => 'Rating star is not sufficient',
            'b_id' => $b_id,
            'rating_level' => $ratingLevel
        ], 400);
    }
}

// create a class display rating button if this input email is not rating on this bodybuilder but isnot display
    public function displayRatingButton(Request $request)
    {
        $m_email = $request->input('m_email');
        $b_id = $request->input('b_id');

        if (!$m_email || !$b_id) {
            return response()->json(['message' => 'Email and bodybuilder ID required'], 400);
        }

        // Check if the member has already rated this bodybuilder
        $hasRated = Rating::where('m_email', $m_email)->where('b_id', $b_id)->exists();

        if ($hasRated) {
            return response()->json(['message' => 'You have already rated this bodybuilder'], 200);
        }

        return response()->json(['message' => 'You can rate this bodybuilder'], 200);

}
}