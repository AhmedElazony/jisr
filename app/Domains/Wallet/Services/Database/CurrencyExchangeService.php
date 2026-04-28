<?php

namespace App\Domains\Wallet\Services\Database;

use App\Domains\Wallet\Services\Contracts\CurrencyExchangeService as CurrencyExchangeServiceContract;
use InvalidArgumentException;

class CurrencyExchangeService implements CurrencyExchangeServiceContract
{
    private array $ratesInUSD;

    public function __construct()
    {
        $this->ratesInUSD = config('currency.rates_in_usd');
    }

    public function convert(float $amount, string $from, string $to): array
    {
        $from = strtoupper(trim($from));
        $to   = strtoupper(trim($to));

        if (! isset($this->ratesInUSD[$from])) {
            throw new InvalidArgumentException("Currency '{$from}' is not supported.");
        }

        if (! isset($this->ratesInUSD[$to])) {
            throw new InvalidArgumentException("Currency '{$to}' is not supported.");
        }

        $amountInUSD     = $amount / $this->ratesInUSD[$from];
        $convertedAmount = $amountInUSD * $this->ratesInUSD[$to];

        return [
            'from'             => $from,
            'to'               => $to,
            'original_amount'  => round($amount, 2),
            'converted_amount' => round($convertedAmount, 2),
            'exchange_rate'    => round($this->ratesInUSD[$to] / $this->ratesInUSD[$from], 6),
        ];
    }

    public function getSupportedCurrencies(): array
    {
        return array_keys($this->ratesInUSD);
    }
}