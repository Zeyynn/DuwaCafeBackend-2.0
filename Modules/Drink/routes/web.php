<?php

use Illuminate\Support\Facades\Route;
use Modules\Drink\Http\Controllers\DrinkController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('drinks', DrinkController::class)->names('drink');
});
