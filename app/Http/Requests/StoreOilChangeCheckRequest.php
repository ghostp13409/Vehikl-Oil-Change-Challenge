<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOilChangeCheckRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'current_odometer' => ['required', 'numeric', 'min:0', 'gt:previous_oil_change_odometer'],
            'previous_oil_change_date' => ['required', 'date', 'before_or_equal:today'],
            'previous_oil_change_odometer' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'current_odometer.gt' => 'The current odometer reading must be greater than the previous oil change odometer reading.',
            'previous_oil_change_date.before_or_equal' => 'The previous oil change date cannot be in the future.',
        ];
    }
}
