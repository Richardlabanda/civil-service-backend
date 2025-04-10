<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsertQuestionController;
use App\Http\Controllers\AuthController;


Route::post('/questions', [InsertQuestionController::class, 'store']);
Route::get('/questions', [InsertQuestionController::class, 'index']);
Route::delete('/questions/{id}', [InsertQuestionController::class, 'delete']); 


Route::get('/users', function() {
    return response()->json(DB::table('users')->get());
});
Route::delete('/users/{id}', [AuthController::class, 'delete']);