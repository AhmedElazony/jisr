<?php

namespace App\Http\Api\V1\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class SendTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'receiver_phone' => ['required', 'string', 'exists:users,phone'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'receiver_full_name' => ['required', 'string', 'max:255'],
            'reason' => ['sometimes', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'receiver_phone.exists' => 'لم يتم العثور على المستخدم المستلم.',
            'amount.min' => 'يجب أن يكون المبلغ أكبر من 0.',
        ];
    }
}
