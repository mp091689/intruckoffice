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
            'price' => ['required', 'numeric', 'max_digits:10'],
            'percentage' => ['required', 'integer', 'max:100', 'min:0'],
            'distance' => ['required', 'numeric', 'max_digits:10'],
            'pickup_address' => ['required', 'string', 'min:5'],
            'pickup_datetime' => ['required', 'date'],
            'dropoff_address' => ['required', 'string', 'min:5'],
            'dropoff_datetime' => ['required', 'date', 'min:5'],
            'description' => ['string'],
        ];
    }


}
