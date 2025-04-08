<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsertQuestionController;

Route::post('/questions', [InsertQuestionController::class, 'store']);
Route::get('/questions', [InsertQuestionController::class, 'index']);
Route::delete('/questions/{id}', [InsertQuestionController::class, 'delete']); 