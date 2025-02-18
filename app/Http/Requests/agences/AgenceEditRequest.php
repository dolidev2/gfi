<?php

namespace App\Http\Requests\agences;

use Illuminate\Foundation\Http\FormRequest;

class AgenceEditRequest extends FormRequest
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
            'contact' => 'max:255',
            'adresse' => 'max:255',
            'status' => ['required','in:'.implode(',',['principale','annexe'])],
            'email' => 'max:255',
            'image' => 'image|mimes:png,jpg,jpeg|max:5120',
            'bpostale' => 'max:255',
            'ifu' => 'max:255',
            'rccm' => 'max:255',
            'dfiscale' => 'max:255',
            'rimposition' => 'max:255',
        ];
    }
    public function messages ()
    {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'status.required' => 'Le statut est obligatoire',
            'image.image' => 'Le format de fichier est incorrect',
            'image.max' => 'La taille du fichier est trop grande ( < 5120 octets)',
            'email.max' => 'La taille de l\'email est trop grande',
            'adresse.max' => 'La taille de l\'adresse est trop grande',
            'contact.max' => 'La taille du contact est trop grande',
            'status.in' => 'Le statut est incorrect',
        ];
    }
}
