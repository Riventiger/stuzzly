<?php

namespace Modules\UpdateLogs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'module_name' => 'required|string|max:255',
            'type'        => 'required|in:install,update,rollback',
            'status'      => 'required|in:success,failed',
            'details'     => 'nullable|string',
        ];
    }
}
