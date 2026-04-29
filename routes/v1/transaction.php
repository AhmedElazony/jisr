<?php

use App\Http\Api\V1\Controllers\Actions\Transaction\TransactionController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/transactions')->middleware('auth:sanctum')->group(function () {
    Route::post('/send', [TransactionController::class, 'send'])
         ->name('transactions.send');

    Route::get('/history', [TransactionController::class, 'history'])
         ->name('transactions.history');
});