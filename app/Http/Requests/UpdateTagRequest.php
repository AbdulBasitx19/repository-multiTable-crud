<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tagId = $this->route('tag');
        
        return [
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:100',
                \Illuminate\Validation\Rule::unique('tags', 'name')->ignore($tagId),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tag name required.',
            'name.max' => 'Tag name must be< 100 characters .',
            'name.unique' => 'This Tag already exists.',
        ];
    }
}