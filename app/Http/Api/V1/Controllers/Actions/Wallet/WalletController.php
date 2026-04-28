<?php

namespace App\Http\Api\V1\Controllers\Actions\Wallet;

use App\Http\Api\V1\Controllers\ApiController;
use App\Domains\Wallet\Services\Contracts\WalletService;
use Illuminate\Http\JsonResponse;

class WalletController extends ApiController
{
    public function __construct(private WalletService $walletService)
    {
    }

    public function getAllSupportedWallets(): JsonResponse
    {
        $wallets = $this->walletService->getAllSupportedWallets();

        return $this->success(
            message: __('جميع المحافظ المدعومة'),
            data: $wallets
        );
    }
}
