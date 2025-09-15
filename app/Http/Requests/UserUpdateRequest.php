<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserUpdateRequest extends FormRequest
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
        $userId = $this->route('user');
        return [
            'name'     => ['sometimes', 'string', 'max:255'],
            'email'    => ['sometimes', 'email', 'unique:users,email,' . $userId],
            'password' => ['nullable', 'string', 'min:8'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.string'       => 'The name must be a string.',
            'name.max'          => 'The name may not be greater than 255 characters.',

            'email.email'       => 'The email must be a valid email address.',
            'email.unique'      => 'This email is already taken.',

            'password.string'   => 'The password must be a string.',
            'password.min'      => 'The password must be at least 8 characters.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'  => 'error',
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422)
        );
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'email' => $this->filled('email') ? strtolower(trim($this->input('email'))) : null,
        ]);
    }
}
