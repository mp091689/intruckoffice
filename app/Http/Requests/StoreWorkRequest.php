<?php

namespace App\Http\Requests;

use App\Models\WorkType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWorkRequest extends FormRequest
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
            'load_id' => ['required', 'exists:loads,id'],
            'driver_id' => ['required', 'exists:drivers,id'],
            'type' => ['required', Rule::in(WorkType::values())],
            'duration' => ['required', 'integer', 'max_digits:10'],
            'quota' => ['required', 'integer', 'max:100', 'min:0'],
        ];
    }
}
