<?php

namespace App\Http\Requests\users;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'username' => ['required', 'string',  'max:255'],
            'role' => ['required','in:'.implode(',',['user','admin','super_admin'])],
            'status' => ['required','in:'.implode(',',['active','inactive'])],
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
            'status.required' => 'Le statut est obligatoire',
            'status.in' => 'Le statut est incorrect',
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
