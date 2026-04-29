<?php

namespace App\Domains\Transaction\Services\Database;

use App\Domains\Transaction\Models\Transaction;
use App\Domains\Transaction\Services\Contracts\TransactionService as TransactionServiceContract;
use App\Domains\User\Models\User;
use App\Domains\Wallet\Services\Contracts\CurrencyExchangeService as CurrencyExchangeServiceContract;
use App\Domains\Wallet\Services\Database\WalletDetectionService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class TransactionService implements TransactionServiceContract
{
    private const FEE_PERCENTAGE = 0.005;

    public function __construct(
        private readonly CurrencyExchangeServiceContract $currencyExchangeService,
        private readonly WalletDetectionService          $walletDetectionService,
    ) {}

    public function send(
        User   $sender,
        string $receiverPhone,
        float  $amount,
        string $receiverFullName,
        string $reason
    ): Transaction {
        return DB::transaction(function () use ($sender, $receiverPhone, $amount, $receiverFullName, $reason) {

            $receiver = User::where('phone', $receiverPhone)
                            ->lockForUpdate()
                            ->firstOrFail();

            if ($receiver->id === $sender->id) {
                throw new RuntimeException('You cannot send money to yourself.');
            }

            $senderWallet   = $this->walletDetectionService->detectByPhone($sender->phone);
            $receiverWallet = $this->walletDetectionService->detectByPhone($receiverPhone);

            $senderPivot = $sender->wallets()
                                  ->where('wallet_id', $senderWallet->id)
                                  ->lockForUpdate()
                                  ->first();

            if (! $senderPivot) {
                throw new RuntimeException('Sender does not have this wallet linked.');
            }

            $fee = round($amount * self::FEE_PERCENTAGE, 2);
            $totalDeducted = round($amount + $fee, 2);

            if ($senderPivot->pivot->balance < $totalDeducted) {
                throw new RuntimeException(
                    "Insufficient balance. Required: {$totalDeducted} {$senderWallet->currency} " .
                    "(includes {$fee} {$senderWallet->currency} fee). " .
                    "Available: {$senderPivot->pivot->balance} {$senderWallet->currency}."
                );
            }

            $receiverPivot = $receiver->wallets()
                                      ->where('wallet_id', $receiverWallet->id)
                                      ->lockForUpdate()
                                      ->first();

            if (! $receiverPivot) {
                throw new RuntimeException('Receiver does not have this wallet linked.');
            }

            $senderCurrency   = $senderWallet->currency;
            $receiverCurrency = $receiverWallet->currency;

            if ($senderCurrency === $receiverCurrency) {
                $receiverAmount = $amount;
                $exchangeRate   = 1.0;
            } else {
                $conversion     = $this->currencyExchangeService->convert(
                    $amount,
                    $senderCurrency,
                    $receiverCurrency
                );
                $receiverAmount = $conversion['converted_amount'];
                $exchangeRate   = $conversion['exchange_rate'];
            }

            $sender->wallets()->updateExistingPivot($senderWallet->id, [
                'balance' => $senderPivot->pivot->balance - $totalDeducted,
            ]);

            $receiver->wallets()->updateExistingPivot($receiverWallet->id, [
                'balance' => $receiverPivot->pivot->balance + $receiverAmount,
            ]);

            return Transaction::create([
                'sender_id'          => $sender->id,
                'receiver_id'        => $receiver->id,
                'receiver_full_name' => $receiverFullName,
                'reason'             => $reason,
                'sender_amount'      => $amount,
                'sender_currency'    => $senderCurrency,
                'receiver_amount'    => $receiverAmount,
                'receiver_currency'  => $receiverCurrency,
                'exchange_rate'      => $exchangeRate,
                'transaction_fee'    => $fee,
                'status'             => 'completed',
            ]);
        });
    }

    public function getHistory(User $user): LengthAwarePaginator
    {
        return Transaction::where('sender_id', $user->id)
                          ->orWhere('receiver_id', $user->id)
                          ->orderByDesc('created_at')
                          ->paginate(15);
    }
}