<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
        $id = request()->post('department_id', 0);
        return [
            'department_name' => "required|string|min:3|max:255|unique:departments,department_name,$id",
            'department_logo' => "$rule|image|dimensions:min_width=100,min_height=100",
        ];
    }
}
