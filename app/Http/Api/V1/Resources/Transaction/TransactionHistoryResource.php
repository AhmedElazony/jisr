<?php

namespace App\Http\Api\V1\Resources\Transaction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionHistoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $isSender = $this->sender_id === $request->user()->id;

        return [
            'reference_code'     => $this->reference_code,
			'type'               => $isSender ? 'sent' : 'received',
            'sender_name'        => $this->sender?->name,
            'receiver_full_name' => $this->receiver_full_name,
            'reason'             => $this->reason,
            'amount'             => $isSender ? $this->sender_amount   : $this->receiver_amount,
            'currency'           => $isSender ? $this->sender_currency : $this->receiver_currency,
            'transaction_fee'    => $isSender ? $this->transaction_fee : null,
            'exchange_rate'      => $this->exchange_rate,
            'status'             => $this->status,
            'created_at'         => $this->created_at->toDateTimeString(),
        ];
    }
}