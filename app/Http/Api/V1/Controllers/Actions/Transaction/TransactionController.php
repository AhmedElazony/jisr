<?php

namespace App\Http\Api\V1\Controllers\Actions\Transaction;

use App\Domains\Transaction\Services\Contracts\TransactionService as TransactionServiceContract;
use App\Http\Api\V1\Controllers\Actions\Controller;
use App\Http\Api\V1\Requests\Transaction\SendTransactionRequest;
use App\Http\Api\V1\Resources\Transaction\TransactionHistoryResource;
use App\Http\Api\V1\Resources\Transaction\TransactionResource;
use App\Support\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException;

class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionServiceContract $transactionService
    ) {}

    public function send(SendTransactionRequest $request): JsonResponse
    {
        try {
            $transaction = $this->transactionService->send(
                sender:           $request->user(),
                receiverPhone:    $request->validated('receiver_phone'),
                amount:           (float) $request->validated('amount'),
                receiverFullName: $request->validated('receiver_full_name'),
                reason:           $request->validated('reason'),
            );

            return ApiResponse::success(
                message: 'تم التحويل بنجاح',
                data: new TransactionResource($transaction)
            );

        } catch (RuntimeException $e) {
            return ApiResponse::error(
                message: $e->getMessage(),
            );
        }
    }

    public function history(Request $request): JsonResponse
    {
        $transactions = $this->transactionService->getHistory($request->user());

        return ApiResponse::success(
            message: __('تم جلب سجل المعاملات بنجاح'),
            data: TransactionHistoryResource::collection($transactions)
        );
    }
}