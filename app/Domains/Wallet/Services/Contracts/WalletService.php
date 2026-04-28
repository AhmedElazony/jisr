<?php

namespace App\Domains\Wallet\Services\Contracts;

use App\Support\Services\Contracts\BaseService;

interface WalletService extends BaseService
{
    public function getAllSupportedWallets(): \Illuminate\Database\Eloquent\Collection;
}