<?php

namespace App\Http\Requests\users;

use Illuminate\Foundation\Http\FormRequest;

class UserEditPasswordRequest extends FormRequest
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
            'password' => ['required', 'string', 'max:255', 'unique:users,password'],
            'cpassword' => ['required', 'string', 'max:255', 'same:password'],
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'Le mot de passe est obligatoire',
            'password.max' => 'Le mot de passe est trop long',
            'password.unique' => 'Le mot de passe existe déjà',
            'cpassword.required' => 'Le mot de passe confirmé est obligatoire',
            'cpassword.same' => 'Le mot de passe et le mot de passe confirmé ne correspondent pas',
        ];
    }
}
