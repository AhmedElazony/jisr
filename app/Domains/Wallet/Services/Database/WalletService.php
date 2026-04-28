<?php

namespace App\Domains\Wallet\Services\Database;

use App\Domains\Wallet\Models\Wallet;
use App\Domains\Wallet\Services\Contracts\WalletService as WalletServiceContract;
use App\Support\Services\Database\BaseService;
use Illuminate\Database\Eloquent\Collection;

class WalletService extends BaseService implements WalletServiceContract
{
    public function __construct()
    {
        parent::__construct(Wallet::class);
    }

    public function getAllSupportedWallets(): Collection
    {
        return Wallet::all();
    }
}