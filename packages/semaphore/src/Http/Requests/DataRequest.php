<?php

namespace Semaphore\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'end' => [],
            'metric' => ['required'],
            'start' => [],
            'instance' => ['required'],
        ];
    }
}
