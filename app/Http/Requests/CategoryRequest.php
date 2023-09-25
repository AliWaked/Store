<?php

namespace App\Http\Requests;

use App\Enums\CategoryStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CategoryRequest extends FormRequest
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
        request()->method() === 'PUT' ? $rule = 'nullable' : $rule = 'required';
        $id = request()->post('category_id', 0);
        return [
            'name' => ['required', 'string', 'min:3', 'max:255', "unique:categories,name,$id"],
            'status' => ["required", 'string', new Enum(CategoryStatus::class)],
            'parent_id' => 'nullable|int|exists:categories,id',
            'category_logo' => "$rule|image",
            'department' => ['required', 'array'],
            'department.*' => ['required', 'exists:departments,id'],
        ];
    }
}
