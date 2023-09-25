<?php

namespace App\Http\Requests;

use App\Rules\CheckProductColorSize;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $id = request()->post('product_id', 0);
        request()->method() === 'PUT' ? $rule = 'nullable' : $rule = 'required';
        return [
            'product_name' => "required|string|min:3|max:255|unique:products,product_name,$id",
            'color' => ['required', 'array', new CheckProductColorSize],
            'category_id' => 'required|integer|exists:categories,id',
            'product_image' => "$rule|image",
            'price' => 'required|numeric|gt:0',
            'department_id' => 'required|integer|exists:departments,id',
        ];
    }
}
