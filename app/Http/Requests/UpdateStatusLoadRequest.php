<?php

namespace App\Http\Requests;

use App\Models\Load;
use App\Models\LoadStatus;
use Illuminate\Validation\Rule;

class UpdateStatusLoadRequest extends StoreLoadRequest
{
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(LoadStatus::values())],
        ];
    }
}
