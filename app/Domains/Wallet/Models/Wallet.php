<?php

namespace App\Domains\Wallet\Models;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'provider',
        'currency',
        'balance',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function hasEnoughBalance(float $amount): bool
    {
        return $this->balance >= $amount;
    }

    public function debit(float $amount): self
    {
        if (!$this->hasEnoughBalance($amount)) {
            throw new \RuntimeException(
                "Insufficient balance. Required: {$amount} {$this->currency}, Available: {$this->balance} {$this->currency}"
            );
        }
        
        $this->balance -= $amount;
        $this->save();
        
        return $this;
    }

    public function credit(float $amount): self
    {
        $this->balance += $amount;
        $this->save();
        
        return $this;
    }
    public function isProvider(string $providerName): bool
    {
        return $this->provider === $providerName;
    }

    // public function getProviderSlug(): string
    // {
    //     return match($this->provider) {
    //         'Vodafone Cash' => 'vodafone_cash',
    //         'STC Pay' => 'stc_pay',
    //         'Orange Money' => 'orange_money',
    //         'Fawry' => 'fawry',
    //         default => 'unknown',
    //     };
    // }
}