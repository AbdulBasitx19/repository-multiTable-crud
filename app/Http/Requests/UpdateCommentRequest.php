<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'comment_text' => 'sometimes|required|string|max:500',
        ];
    }

    /**
     * Custom error messages
     */
    public function messages(): array
    {
        return [
            'comment_text.required' => 'Comment text required',
            'comment_text.max' => 'Comment must be lesser than 500 characters',
        ];
    }
}