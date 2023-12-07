<?php

namespace App\Http\Requests;

use Arr;
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
        $this->request->set('zipCodes', $this->get('zipCodes') ?? []);

        $rules = [
            'dispatcher_id' => ['required', 'exists:dispatchers,id'],
            'estimated_price' => ['required', 'numeric', 'max_digits:10'],
            'estimated_distance' => ['required', 'integer', 'max_digits:10'],
            'actual_price' => ['numeric', 'max_digits:10'],
            'actual_distance' => ['integer', 'max_digits:10'],
            'description' => [],
            'zipCodes' => ['array'],
        ];

        return array_merge(
            $rules,
            (new LoadStatusRequest())->rules(),
            Arr::prependKeysWith((new ZipCodeRequest())->rules(), 'zipCodes.*.')
        );
    }
}
