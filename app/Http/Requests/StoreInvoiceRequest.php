<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInvoiceRequest extends FormRequest
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
            'number' => ['required', 'regex:/^ITO-[\d]{10}$/'],
            'total' => ['required', 'numeric', 'max_digits:10'],
            'generated_log' => ['required'],
            'custom_total' => ['numeric', 'max_digits:10'],
            'custom_work' => [],
            'work_ids' => ['array'],
            'work_ids.*' => [Rule::exists('works', 'id')],
        ];
    }
}
