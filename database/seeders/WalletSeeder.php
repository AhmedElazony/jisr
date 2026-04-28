<?php

namespace Database\Seeders;

use App\Domains\Wallet\Models\Wallet;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    public function run(): void
    {
        $wallets = [
            [
                'dial_code' => '+966',
                'flag' => '🇸🇦',
                'country' => 'السعودية',
                'name' => 'STC Pay',
                'currency' => 'SAR',
            ],
            [
                'dial_code' => '+971',
                'flag' => '🇦🇪',
                'country' => 'الإمارات',
                'name' => 'Careem Pay',
                'currency' => 'AED',
            ],
            [
                'dial_code' => '+962',
                'flag' => '🇯🇴',
                'country' => 'الأردن',
                'name' => 'Zain Cash',
                'currency' => 'JOD',
            ],
            [
                'dial_code' => '+965',
                'flag' => '🇰🇼',
                'country' => 'الكويت',
                'name' => 'K-Net',
                'currency' => 'KWD',
            ],
            [
                'dial_code' => '+212',
                'flag' => '🇲🇦',
                'country' => 'المغرب',
                'name' => 'CIH',
                'currency' => 'MAD',
            ],
            [
                'dial_code' => '+20',
                'flag' => '🇪🇬',
                'country' => 'مصر',
                'name' => 'InstaPay',
                'currency' => 'EGP',
            ],
        ];

        foreach ($wallets as $wallet) {
            Wallet::create($wallet);
        }
    }
}
