<?php

namespace App\Domains\Transaction\Events;

use App\Domains\Transaction\Models\Transaction;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransactionSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        protected Transaction $transaction
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('transaction.user.'.$this->transaction->receiver_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'transaction.sent';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->transaction->id,
            'amount' => $this->transaction->amount,
            'sender_id' => $this->transaction->sender_id,
            'receiver_id' => $this->transaction->receiver_id,
            'created_at' => $this->transaction->created_at->toDateTimeString(),
        ];
    }
}
