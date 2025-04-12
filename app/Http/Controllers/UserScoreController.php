<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserScoreController extends Controller
{
    // Store a user's score
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'category' => 'required|string|max:100',
            'score' => 'required|integer|min:0',
        ]);

        DB::table('user_scores')->insert([
            'user_id' => $validated['user_id'],
            'category' => $validated['category'],
            'score' => $validated['score'],
            'taken_at' => now(),
        ]);

        return response()->json(['message' => 'Score saved successfully!'], 201);
    }

    // Get all scores
    public function index()
    {
        $scores = DB::table('user_scores')->get();
        return response()->json($scores);
    }

    // Get scores for a specific user
    public function getUserScores($userId)
    {
        $scores = DB::table('user_scores')
            ->where('user_id', $userId)
            ->orderBy('taken_at', 'desc')
            ->get();

        return response()->json($scores);
    }
}
