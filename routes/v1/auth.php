<?php

use App\Http\Api\V1\Controllers\Actions\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::post('/login', LoginController::class)->name('login');
});
