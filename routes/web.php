<?php

use App\Http\Controllers\PerangkatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/perangkat', [PerangkatController::class, 'index']);
