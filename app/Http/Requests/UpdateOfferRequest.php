<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'description' => 'nullable|string|max:1000',
            'discount_value' => 'required|numeric|min:0|max:100',
            'start_at' => 'nullable|date|after_or_equal:today',
            'end_at' => 'nullable|date|after:start_at',
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
            'discount_value.required' => 'قيمة الخصم مطلوبة',
            'discount_value.numeric' => 'قيمة الخصم يجب أن تكون رقماً',
            'discount_value.min' => 'قيمة الخصم يجب أن تكون أكبر من أو تساوي 0',
            'discount_value.max' => 'قيمة الخصم يجب أن تكون أقل من أو تساوي 100',
            'start_at.after_or_equal' => 'تاريخ البداية يجب أن يكون اليوم أو بعده',
            'end_at.after' => 'تاريخ النهاية يجب أن يكون بعد تاريخ البداية',
            'description.max' => 'وصف العرض يجب أن يكون أقل من 1000 حرف',
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
            'discount_value' => 'قيمة الخصم',
            'start_at' => 'تاريخ البداية',
            'end_at' => 'تاريخ النهاية',
            'description' => 'وصف العرض',
        ];
    }
}
