<?php
// app/Domains/Wallet/Services/Contracts/CurrencyExchangeService.php

namespace App\Domains\Wallet\Services\Contracts;

interface CurrencyExchangeService
{
    public function convert(float $amount, string $from, string $to): array;
    public function getSupportedCurrencies(): array;
}