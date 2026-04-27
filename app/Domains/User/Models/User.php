<?php

namespace App\Domains\User\Models;

use App\Domains\Wallet\Models\Wallet;
use App\Support\Traits\HasFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasFilters, Notifiable;

    protected $fillable = [
        'name',
        'jisr_email',
        'phone',
        'country',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public static function generateJisrEmail(string $name): string
    {
        $firstName = Str::lower(Str::before(trim($name), ' '));
        $base = "{$firstName}@jisr";
        
        $count = static::where('jisr_email', 'like', "{$firstName}%")->count();
        
        return $count > 0 ? "{$firstName}{$count}@jisr" : $base;
    }


    // public static function resolveByIdentifier(string $identifier): ?self
    // {
    //     // Phone number (starts with +)
    //     if (Str::startsWith($identifier, '+')) {
    //         return static::where('phone', $identifier)->first();
    //     }
        
    //     // Jisr email (ends with @jisr)
    //     if (Str::endsWith($identifier, '@jisr')) {
    //         return static::where('jisr_email', $identifier)->first();
    //     }
        
    //     // Regular email (fallback)
    //     return static::where('email', $identifier)->first();
    //}

    // ──────────────────────────────────────────────
    // Helper Methods
    // ──────────────────────────────────────────────

    // public function isInCountry(string $countryCode): bool
    // {
    //     return $this->country === $countryCode;
    // }

    public function getCurrencyCode(): string
    {
        return $this->wallet?->currency ?? 'EGP';
    }

    public function getBalance(): float
    {
        return (float) ($this->wallet?->balance ?? 0);
    }
}