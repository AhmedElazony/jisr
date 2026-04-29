<?php

namespace App\Domains\Transaction\Services\Contracts;

use App\Domains\Transaction\Models\Transaction;
use App\Domains\User\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface TransactionService
{
    public function send(
        User   $sender,
        string $receiverPhone,
        float  $amount,
        string $receiverFullName,
        string $reason
    ): Transaction;

    public function getHistory(User $user): LengthAwarePaginator;
}