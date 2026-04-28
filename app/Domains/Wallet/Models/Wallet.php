<?php
// app/Domains/Wallet/Models/Wallet.php

namespace App\Domains\Wallet\Models;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Wallet extends Model
{
    protected $fillable = [
        'dial_code',
        'flag',
        'country',
        'name',
        'currency',
    ];

    public function users(): BelongsToMany
    {
    return $this->belongsToMany(User::class, 'wallet_users')
                ->withPivot('balance')
                ->withTimestamps();
    }
}