<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TransactionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/order', [TransactionController::class, 'store']);
Route::get('/bill/{id}', [TransactionController::class, 'show']);