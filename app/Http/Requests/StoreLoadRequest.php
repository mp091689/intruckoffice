<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoadRequest extends FormRequest
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
            'pickup_address' => ['required', 'string', 'min:5'],
            'pickup_datetime' => ['required', 'date'],
            'dropoff_address' => ['required', 'string', 'min:5'],
            'dropoff_datetime' => ['required', 'date', 'min:5'],
            'dispatcher_id' => ['required', 'exists:dispatchers,id'],
            'price' => ['required', 'numeric', 'max_digits:10'],
            'distance' => ['required', 'numeric', 'max_digits:10'],
            'description' => ['required'],
            'driver_id' => ['required', 'exists:drivers,id'],
            'percentage' => ['required', 'integer', 'max:100', 'min:0'],
            'driver2_id' => ['nullable', 'exists:drivers,id', 'different:driver_id'],
            'percentage2' => ['required', 'integer', 'max:100', 'min:0'],
        ];
    }

    /** @inheritDoc */
    public function messages(): array
    {
        return [
            'driver_id.exists' => 'Driver does not exist.',
            'driver2_id.exists' => 'Driver does not exist.',
            'driver2_id.different' => 'Driver 2 field and Driver must be different.'
        ];
    }
}
