<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EduzzWebhookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return hash_hmac('sha256', $this->getContent(), config('eduzz.secret_key'))
            === $this->header('x-signature');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data.buyer.name' => 'required',
            'data.buyer.email' => 'required|email',
            'data.buyer.document' => 'required',
            'data.items.*.productId' => 'required',
        ];
    }
}
