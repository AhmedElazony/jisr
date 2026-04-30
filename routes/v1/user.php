<?php

use App\Domains\User\Models\User;
use App\Support\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::get('/q', function () {
        $user = User::where('phone', '=', '+'.request()->query('phone'))
            ->firstOrFail();

        return ApiResponse::success(
            __('تم'),
            ['name' => $user->name]
        );
    });
});
