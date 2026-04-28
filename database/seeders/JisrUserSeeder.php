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
        // Create users
        $ahmed = User::create([
            'name' => 'Ahmed tamer',
            'jisr_email' => 'ahmed@jisr',
            'phone' => '+201001234567',
            'country' => 'EG',
            'password' => Hash::make('password'),
            'phone_verified_at' => now(),
            'email_verified_at' => now(),
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

        $fahad = User::create([
            'name' => 'Fahad Al-Otaibi',
            'jisr_email' => 'fahad@jisr',
            'phone' => '+966501234567',
            'country' => 'SA',
            'password' => Hash::make('password'),
            'phone_verified_at' => now(),
            'email_verified_at' => now(),
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

        $omar = User::create([
            'name' => 'Omar Al-Mansouri',
            'jisr_email' => 'omar@jisr',
            'phone' => '+971501234567',
            'country' => 'AE',
            'password' => Hash::make('password'),
            'phone_verified_at' => now(),
            'email_verified_at' => now(),
        ]);

        $layla = User::create([
            'name' => 'Layla Al-Harbi',
            'jisr_email' => 'layla@jisr',
            'phone' => '+962791234567',
            'country' => 'JO',
            'password' => Hash::make('password'),
            'phone_verified_at' => now(),
            'email_verified_at' => now(),
        ]);

        // Get wallets
        $instaPayWallet = Wallet::where('name', 'InstaPay')->first();
        $stcPayWallet = Wallet::where('name', 'STC Pay')->first();
        $careemPayWallet = Wallet::where('name', 'Careem Pay')->first();
        $zainCashWallet = Wallet::where('name', 'Zain Cash')->first();

        // Attach users to wallets
        if ($instaPayWallet) {
            $ahmed->wallets()->attach($instaPayWallet->id, ['balance' => 5000.00]);
            $mona->wallets()->attach($instaPayWallet->id, ['balance' => 3500.00]);
        }

        if ($stcPayWallet) {
            $fahad->wallets()->attach($stcPayWallet->id, ['balance' => 2000.00]);
            $noura->wallets()->attach($stcPayWallet->id, ['balance' => 1500.00]);
        }

        if ($careemPayWallet) {
            $omar->wallets()->attach($careemPayWallet->id, ['balance' => 3000.00]);
        }

        if ($zainCashWallet) {
            $layla->wallets()->attach($zainCashWallet->id, ['balance' => 2500.00]);
        }

        // Some users with multiple wallets
        if ($instaPayWallet && $zainCashWallet) {
            $layla->wallets()->attach($instaPayWallet->id, ['balance' => 1000.00]);
        }

        if ($stcPayWallet && $careemPayWallet) {
            $omar->wallets()->attach($stcPayWallet->id, ['balance' => 1800.00]);
        }
    }
}