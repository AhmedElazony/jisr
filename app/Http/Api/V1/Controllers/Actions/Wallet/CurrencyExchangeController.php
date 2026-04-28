<?php

namespace App\Http\Api\V1\Controllers\Actions\Wallet;

use App\Domains\Wallet\Services\Contracts\CurrencyExchangeService as CurrencyExchangeServiceContract;
use App\Http\Api\V1\Controllers\Actions\Controller;
use App\Http\Api\V1\Requests\Wallet\CurrencyConvertRequest;
use App\Support\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;

class CurrencyExchangeController extends Controller
{
    public function __construct(
        private readonly CurrencyExchangeServiceContract $exchangeService
    ) {}

    public function convert(CurrencyConvertRequest $request): JsonResponse
    {
        try {
            $result = $this->exchangeService->convert(
                amount: (float) $request->validated('amount'),
                from:   $request->validated('from'),
                to:     $request->validated('to'),
            );

            return ApiResponse::success(
                message: __('قيمة المبلغ المحول'),
                data: $result
            );

        } catch (InvalidArgumentException $e) {
            return ApiResponse::error(
                message: $e->getMessage(),
            );
        }
    }

    public function supported(): JsonResponse
    {
        return ApiResponse::success(
            message: __('جميع العملات المدعومة '),
            data: [
                'currencies' => $this->exchangeService->getSupportedCurrencies(),
            ]
        );
    }
}