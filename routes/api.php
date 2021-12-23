<?php

use App\Http\Controllers\Api\RegisterController;
use Illuminate\Support\Facades\Route;

Route::post('/register/complete', [RegisterController::class, 'complete'])->name('api.register.complete');


