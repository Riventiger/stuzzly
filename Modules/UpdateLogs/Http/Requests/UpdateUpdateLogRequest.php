<?php

namespace Modules\UpdateLogs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUpdateLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'module_name' => 'sometimes|required|string|max:255',
            'type'        => 'sometimes|required|in:install,update,rollback',
            'status'      => 'sometimes|required|in:success,failed',
            'details'     => 'nullable|string',
        ];
    }
}
