<?php

use App\Support\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () {
    require __DIR__.'/v1/auth.php';
    require __DIR__.'/v1/wallet.php';

    require __DIR__.'/v1/user.php';

    Route::get('/me', function () {
        $user = auth()->user();
        $balance = $user->getBalance();

        return ApiResponse::success(
            message: __('تم التسجيل بنجاح'),
            data: [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'jisr_email' => $user->jisr_email,
                    'phone' => $user->phone,
                    'country' => $user->country,
                    'wallet_balance' => $balance,
                ],
            ]
        );
    })->middleware('auth:sanctum');
});
