<?php

namespace App\Http\Api\V1\Controllers\Actions\Auth;

use App\Http\Api\V1\Controllers\Actions\Controller;
use App\Http\Api\V1\Requests\Auth\LoginRequest;
use App\Domains\User\Models\User;
use App\Support\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $user = User::where('jisr_email', $request->jisr_email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'jisr_email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('jisr-api')->plainTextToken;

        return ApiResponse::success(
            message: __('Login successful'),
            data: [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'jisr_email' => $user->jisr_email,
                    'phone' => $user->phone,
                    'country' => $user->country,
                ],
                'token' => $token,
            ]
        );
    }
}