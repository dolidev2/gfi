<?php

namespace App\Http\Requests\clients;

use Illuminate\Foundation\Http\FormRequest;

class ClientAddRequest extends FormRequest
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
            'nom' => 'required|string|max:255',
            'statut_juridique' => ['required','in:'.implode(',',[env ('STATUS_JURIDIQUE_PARTICULIER'),env('STATUS_JURIDIQUE_MORAL'),env('STATUS_JURIDIQUE_COMMERCIAL')])],
            'photoProfile' => 'image|mimes:png,jpg,jpeg|max:5120',
        ];
    }

    public function messages ()
    {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'statut_juridique.required' => 'Le statut juridique est obligatoire',
            'photoProfile.max'=>'La taille du fichier est trop grande ( < 5120 octets)',
            'photoProfile.image'=>'Le format de fichier est incorrect',
            ];
    }
}
