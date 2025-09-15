<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BlogStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:255'],
            'content'      => ['required', 'string'],
            'is_published' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'   => 'The blog title is required.',
            'title.string'     => 'The blog title must be a string.',
            'title.max'        => 'The blog title may not be greater than 255 characters.',

            'content.required' => 'The blog content is required.',
            'content.string'   => 'The blog content must be a string.',

            'is_published.boolean' => 'The is_published field must be true or false.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'  => 'error',
            'message' => 'Validation failed',
            'errors'  => $validator->errors(),
        ], 422));
    }
}
