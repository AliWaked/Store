<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'countiry' => 'required|max:255',
            'phone_number' => 'required|max:13',
            'postal_code' => 'required|string|max:8',
        ];
    }
}
