<?php

namespace App\Domains\Wallet\Services\Database;

use App\Domains\Wallet\Models\Wallet;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use RuntimeException;

class WalletDetectionService
{
    private function getSupportedWallets(): Collection
    {
        return Cache::remember('supported_wallets', now()->addDay(), function () {
            return Wallet::all();
        });
    }

    public function detectByPhone(string $phone): Wallet
    {
        $wallet = $this->getSupportedWallets()->first(function (Wallet $wallet) use ($phone) {
            return str_starts_with($phone, $wallet->dial_code);
        });

        if (! $wallet) {
            throw new RuntimeException(
                "No supported wallet found for phone number '{$phone}'. " .
                "Supported dial codes: " . $this->getSupportedWallets()->pluck('dial_code')->implode(', ')
            );
        }

        return $wallet;
    }
}