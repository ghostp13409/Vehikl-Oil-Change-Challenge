<?php

use App\Http\Controllers\OilChangeController;
use Illuminate\Support\Facades\Route;

Route::get("/", [OilChangeController::class, "index"])->name("home");
Route::post("/check", [OilChangeController::class, "check"])->name("check");
Route::get("/result/{id}", [OilChangeController::class, "result"])->name(
    "result",
);
