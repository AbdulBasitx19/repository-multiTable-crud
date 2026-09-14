<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100|unique:tags,name',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tag name required.',
            'name.max' => 'Tag name must be < 100 characters .',
            'name.unique' => 'This Tag already exists.',
        ];
    }
}