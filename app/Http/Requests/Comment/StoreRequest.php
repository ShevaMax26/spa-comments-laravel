<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'parent_id' => ['nullable', 'integer', 'exists:comments,id'],
            'message' => ['required', 'string'],
            'image' => [
                'nullable',
                'file',
                'image',
                'max:10000',
                'mimes:jpeg,png,gif'
            ],
            'text_file' => [
                'nullable',
                'file',
                'max:100',
                'mimes:txt',
            ],
        ];
    }
}
