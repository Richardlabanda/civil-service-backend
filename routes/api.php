<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\InsertQuestionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserScoreController;

// Questions
Route::post('/questions', [InsertQuestionController::class, 'store']);
Route::get('/questions', [InsertQuestionController::class, 'index']);
Route::delete('/questions/{id}', [InsertQuestionController::class, 'delete']);

// Auth
Route::get('/users', function () {
    return response()->json(DB::table('users')->get());
});
Route::delete('/users/{id}', [AuthController::class, 'delete']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// User Scores
Route::post('/user_scores', [UserScoreController::class, 'store']);
Route::get('/user_scores', [UserScoreController::class, 'index']);
Route::get('/user_scores/{userId}', [UserScoreController::class, 'getUserScores']);
