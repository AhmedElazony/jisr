<?php

use App\Http\Api\V1\Controllers\Actions\Wallet\WalletController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'wallets', 'as' => 'wallets.'], function () {
    Route::get('/', [WalletController::class, 'getAllSupportedWallets'])->name('index');
});
