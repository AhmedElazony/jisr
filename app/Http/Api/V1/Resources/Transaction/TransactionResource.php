<?php

namespace App\Http\Api\V1\Resources\Transaction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'reference_code' => $this->reference_code,
            'receiver_full_name' => $this->receiver_full_name,
            'reason' => $this->reason,
            'sender_amount' => $this->sender_amount,
            'sender_currency' => $this->sender_currency,
            'transaction_fee' => $this->transaction_fee,
            'receiver_amount' => $this->receiver_amount,
            'receiver_currency' => $this->receiver_currency,
            'exchange_rate' => $this->exchange_rate,
            'status' => $this->status,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
