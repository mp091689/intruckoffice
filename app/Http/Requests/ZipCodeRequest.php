<?php

namespace App\Http\Requests;

use App\Enums\ZipCodeType;
use App\Services\ZipFinder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ZipCodeRequest extends FormRequest
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
            'zip' => ['required', 'regex:' . ZipFinder::REGEX_ZIP],
            'type' => ['required', Rule::in(ZipCodeType::values())],
            'datetime' => ['required', 'date'],
        ];
    }
}
