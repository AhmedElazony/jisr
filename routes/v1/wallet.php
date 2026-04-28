<?php

use App\Http\Api\V1\Controllers\Actions\Wallet\CurrencyExchangeController;
use App\Http\Api\V1\Controllers\Actions\Wallet\WalletController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'wallets', 'as' => 'wallets.'], function () {
    Route::get('/', [WalletController::class, 'getAllSupportedWallets'])->name('index');
});

Route::prefix('currency')->group(function () {
        Route::get('/supported', [CurrencyExchangeController::class, 'supported'])
             ->name('currency.supported');

        Route::post('/convert', [CurrencyExchangeController::class, 'convert'])
             ->name('currency.convert');
    });
