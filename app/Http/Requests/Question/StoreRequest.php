<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'nullable', 'required_with:parent_id'],
            'text' => ['required', 'string'],
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

    public function authorize(): bool
    {
        return $this->user() !== null;
    }
}
