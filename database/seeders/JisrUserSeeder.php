<?php

namespace Database\Seeders;

use App\Domains\User\Models\User;
use App\Domains\Wallet\Models\Wallet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class JisrUserSeeder extends Seeder
{
    public function run(): void
    {
    
        $ahmed = User::create([
            'name' => 'Ahmed tamer',
            'jisr_email' => 'ahmed@jisr',
            'phone' => '+201001234567',
            'country' => 'EG',
            'password' => Hash::make('password'),
            'phone_verified_at' => now(),
            'email_verified_at' => now(),
        ]);

        Wallet::create([
            'user_id' => $ahmed->id,
            'provider' => 'InstaPay',
            'currency' => 'EGP',
            'balance' => 5000.00,
        ]);

        $mona = User::create([
            'name' => 'Mona Ibrahim',
            'jisr_email' => 'mona@jisr',
            'phone' => '+201009876543',
            'country' => 'EG',
            'password' => Hash::make('password'),
            'phone_verified_at' => now(),
            'email_verified_at' => now(),
        ]);

        Wallet::create([
            'user_id' => $mona->id,
            'provider' => 'Vodafone Cash',
            'currency' => 'EGP',
            'balance' => 3500.00,
        ]);

        $fahad = User::create([
            'name' => 'Fahad Al-Otaibi',
            'jisr_email' => 'fahad@jisr',
            'phone' => '+966501234567',
            'country' => 'SA',
            'password' => Hash::make('password'),
            'phone_verified_at' => now(),
            'email_verified_at' => now(),
        ]);

        Wallet::create([
            'user_id' => $fahad->id,
            'provider' => 'STC Pay',
            'currency' => 'SAR',
            'balance' => 2000.00,
        ]);

        $noura = User::create([
            'name' => 'Noura Al-Ghamdi',
            'jisr_email' => 'noura@jisr',
            'phone' => '+966509876543',
            'country' => 'SA',
            'password' => Hash::make('password'),
            'phone_verified_at' => now(),
            'email_verified_at' => now(),
        ]);

        Wallet::create([
            'user_id' => $noura->id,
            'provider' => 'STC Pay',
            'currency' => 'SAR',
            'balance' => 1500.00,
        ]);

        $omar = User::create([
            'name' => 'Omar Al-Mansouri',
            'jisr_email' => 'omar@jisr',
            'phone' => '+971501234567',
            'country' => 'AE',
            'password' => Hash::make('password'),
            'phone_verified_at' => now(),
            'email_verified_at' => now(),
        ]);

        Wallet::create([
            'user_id' => $omar->id,
            'provider' => 'Fawry',
            'currency' => 'AED',
            'balance' => 3000.00,
        ]);
    }
}