<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'color_id' => 'required|int|exists:colors,id',
            'size_name' => 'required|string',
            'quantity' => 'nullable|numeric|gt:0',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'this filed is required',
            'quantity.numeric' =>  'the quantity must be number',
        ];
    }
}
