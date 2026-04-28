<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () {
    require __DIR__.'/v1/auth.php';
    require __DIR__.'/v1/wallet.php';


    require __DIR__.'/v1/user.php';
});
