<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   
    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'type' => 'nullable|string|max:255',
            'price_before' => 'sometimes|numeric|min:0',
            'price_after' => 'sometimes|numeric|min:0',
            'colors' => 'nullable|array',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'اسم المنتج مطلوب',
            'name.max' => 'اسم المنتج يجب أن يكون أقل من 255 حرف',
            'type.max' => 'نوع المنتج يجب أن يكون أقل من 100 حرف',
            'description.max' => 'وصف المنتج يجب أن يكون أقل من 1000 حرف',
        ];
    }

    /**
     * Get custom attribute names for validation errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'اسم المنتج',
            'type' => 'نوع المنتج',
            'description' => 'وصف المنتج',
            'colors' => 'الألوان',
            'images' => 'الصور',
        ];
    }
}
