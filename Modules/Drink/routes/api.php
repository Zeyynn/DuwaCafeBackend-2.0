<?php

use Illuminate\Support\Facades\Route;
use Modules\Drink\Http\Controllers\DrinkController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('drinks', DrinkController::class)->names('drink');
});
