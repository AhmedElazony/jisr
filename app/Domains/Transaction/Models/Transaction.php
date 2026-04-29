<?php

namespace App\Domains\Transaction\Models;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Transaction extends Model
{
    protected $fillable = [
        'reference_code',
        'sender_id',
        'receiver_id',
        'receiver_full_name',
        'reason',
        'sender_amount',
        'sender_currency',
        'receiver_amount',
        'receiver_currency',
        'exchange_rate',
        'transaction_fee',
        'status',
    ];

    protected $casts = [
        'sender_amount'   => 'decimal:2',
        'receiver_amount' => 'decimal:2',
        'transaction_fee' => 'decimal:2',
        'exchange_rate'   => 'decimal:6',
    ];

    protected static function booted(): void
    {
        static::creating(function (Transaction $transaction) {
            $transaction->reference_code = self::generateReferenceCode();
        });
    }

    public static function generateReferenceCode(): string
    {
        do {
            $code = 'TXN-' . strtoupper(Str::random(4)) . '-' . now()->format('YmdHis');
        } while (self::where('reference_code', $code)->exists());

        return $code;
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}