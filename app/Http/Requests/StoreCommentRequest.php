<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
            'comment_text' => 'required|string|max:500',
        ];
    }

    /**
     * Custom error messages
     */
    public function messages(): array
    {
        return [
            'post_id.required' => 'Commenton which post ? post required.',
            'post_id.exists' => 'Invalid post selected',
            'user_id.required' => 'Comment author required',
            'user_id.exists' => 'Invalid user selected',
            'comment_text.required' => 'Comment text required',
            'comment_text.max' => 'Comment must be < 500 characters ',
        ];
    }
}