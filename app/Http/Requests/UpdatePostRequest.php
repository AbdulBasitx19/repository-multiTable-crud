<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id',

            'comments' => 'nullable|array',
            'comments.*.user_id' => 'required_with:comments|exists:users,id',
            'comments.*.comment_text' => 'required_with:comments|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Post title is required',
            'title.max' => 'Title must be less then 255 characters',
            'description.required' => 'Post description is required.',
            'tags.*.exists' => 'Invalid tag selected',
            'comments.*.user_id.required_with' => 'Comment author required.',
            'comments.*.comment_text.required_with' => 'Comment text required',
            'comments.*.comment_text.max' => 'Comment must be lesser than 500 characters.',
        ];
    }
}