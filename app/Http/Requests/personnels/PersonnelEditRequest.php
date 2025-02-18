<?php

namespace App\Http\Requests\personnels;

use Illuminate\Foundation\Http\FormRequest;

class PersonnelEditRequest extends FormRequest
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
            'nom' => 'required',
            'contact' => 'required',
            'agence' => 'required',
            'statut' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom complet est obligatoire',
            'contact.required' => 'Le contact est obligatoire',
            'agence.required' => 'L\'agence est obligatoire',
            'statut.required' => 'Le statut est obligatoire',
        ];
    }
}
