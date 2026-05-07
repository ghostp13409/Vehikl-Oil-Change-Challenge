<?php

use App\Http\Controllers\OilChangeCheckController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('oil-change.form');
});

Route::post('/check', [OilChangeCheckController::class, 'store']);

Route::get('/check/{oilChangeCheck}', [OilChangeCheckController::class, 'show']);
