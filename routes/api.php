<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PerangkatController;

Route::patch('/perangkat', [PerangkatController::class, 'store']);



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
