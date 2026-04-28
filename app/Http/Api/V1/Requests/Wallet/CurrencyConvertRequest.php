<?php

namespace App\Http\Api\V1\Requests\Wallet;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyConvertRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $supported = implode(',', array_keys(config('currency.rates_in_usd')));

        return [
            'amount' => ['required', 'numeric', 'min:0.01'],
            'from'   => ['required', 'string', 'size:3', "in:{$supported}"],
            'to'     => ['required', 'string', 'size:3', "in:{$supported}"],
        ];
    }

    public function messages(): array
    {
        $supported = implode(', ', array_keys(config('currency.rates_in_usd')));

        return [
            'from.in' => "The 'from' currency is not supported. Supported currencies: {$supported}.",
            'to.in'   => "The 'to' currency is not supported. Supported currencies: {$supported}.",
        ];
    }
}