<?php

namespace App\Http\Api\V1\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Sandbox assumption: all requests are authorized.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'jisr_email' => [
                'required', 
                'string', 
                'email',
                function ($attribute, $value, $fail) {
                    if (!str_ends_with($value, '@jisr')) {
                        $fail('The email must be a @jisr address.');
                    }
                },
            ],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    public function messages(): array
    {
        return [
            'jisr_email.required' => 'Please provide your Jisr email address.',
            'jisr_email.email' => 'Please provide a valid email address.',
            'password.required' => 'Please provide your password.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'jisr_email' => trim(strtolower($this->jisr_email)),
        ]);
    }
}