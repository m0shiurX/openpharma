<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateManufacturerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'location' => 'string',
            'contact_name' => 'string',
            'contact_tel' => 'string|min:8',
        ];
    }
}
