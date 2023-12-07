<?php

namespace App\Http\Requests;

use App\Enums\LoadStatus;
use Illuminate\Validation\Rule;

class LoadStatusRequest extends StoreLoadRequest
{
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(LoadStatus::values())],
        ];
    }
}
