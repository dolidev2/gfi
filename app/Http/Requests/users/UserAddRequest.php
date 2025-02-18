<?php

namespace App\Http\Requests\users;

use Illuminate\Foundation\Http\FormRequest;

class UserAddRequest extends FormRequest
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
            'nom' => ['required', 'string', 'max:255'],
            'contact' => ['max:255'],
            'username' => ['required', 'string','unique:users,username',  'max:255'],
            'role' => ['required','in:'.implode(',',['user','admin','super_admin'])],
            'password' => ['required', 'string', 'max:255', 'unique:users,password'],
            'cpassword' => ['required', 'string', 'max:255', 'same:password'],
            'agence' => ['required'],
            'photoProfile' => [ 'image', 'max:5120'],
            'photoCnibRecto' => [ 'image', 'max:5120'],
            'photoCnibVerso' => [ 'image', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'username.required' => 'Le nom d\'utilisateur est obligatoire',
            'role.required' => 'Le rôle est obligatoire',
            'role.in' => 'Le rôle est incorrect',
            'password.required' => 'Le mot de passe est obligatoire',
            'cpassword.required' => 'Le mot de passe confirmé est obligatoire',
            'cpassword.same' => 'Le mot de passe et le mot de passe confirmé ne correspondent pas',
            'username.unique' => 'Le nom d\'utilisateur existe déjà',
            'password.unique' => 'Le mot de passe existe déjà',
            'agence.required' => 'L\'agence est obligatoire',
            'photoProfile.image' => 'Le format de fichier est incorrect',
            'photoProfile.max' => 'La taille du fichier est trop grande',
            'photoCnibRecto.image' => 'Le format de fichier est incorrect',
            'photoCnibRecto.max' => 'La taille du fichier est trop grande',
            'photoCnibVerso.image' => 'Le format de fichier est incorrect',
            'photoCnibVerso.max' => 'La taille du fichier est trop grande',
        ];
    }
}
