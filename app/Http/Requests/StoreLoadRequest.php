<?php

namespace App\Http\Requests;

use App\Models\Load;
use App\Services\Address;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $updateStatusLoadRequest = new UpdateStatusLoadRequest();

        $rules = [
            'pickup_zip' => ['required', 'regex:' . Address::REGEX_ZIP],
            'pickup_datetime' => ['required', 'date'],
            'dropoff_zip' => ['required', 'regex:' . Address::REGEX_ZIP],
            'dropoff_datetime' => ['required', 'date', 'min:5'],
            'dispatcher_id' => ['required', 'exists:dispatchers,id'],
            'estimated_price' => ['required', 'numeric', 'max_digits:10'],
            'estimated_distance' => ['required', 'integer', 'max_digits:10'],
            'actual_price' => ['numeric', 'max_digits:10'],
            'actual_distance' => ['integer', 'max_digits:10'],
            'description' => [],
        ];

        return array_merge($rules, $updateStatusLoadRequest->rules());
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

    protected function prepareForValidation(): void
    {
        $this->merge([
            'pickup_zip' => strtoupper($this->pickup_zip),
            'dropoff_zip' => strtoupper($this->dropoff_zip),
        ]);
    }
}
