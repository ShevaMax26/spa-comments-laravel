<?php

namespace App\Http\Requests\Comment;

use App\Models\Comment;
use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'parent_id' => [
                'nullable',
                'integer',
                Rule::exists(Comment::class, 'id')
            ],
            'question_id' => [
                'required',
                'numeric',
                Rule::exists(Question::class, 'id')
            ],
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
