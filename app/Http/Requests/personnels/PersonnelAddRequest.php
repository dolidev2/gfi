<?php

namespace App\Http\Requests\personnels;

use Illuminate\Foundation\Http\FormRequest;

class PersonnelAddRequest extends FormRequest
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
            'photoProfile' => 'required|mimes:png,jpg,jpeg,pdf',
            'nom' => 'required',
            'matricule' => 'required',
            'contact' => 'required',
            'agence' => 'required',
            'imageCnibRecto' => 'required|mimes:png,jpg,jpeg,pdf',
            'imageCnibVerso' => 'required|mimes:png,jpg,jpeg,pdf',
        ];
    }

    public function messages()
    {
        return [
            'photoProfile.required' => 'Le photo est obligatoire',
            'nom.required' => 'Le nom complet est obligatoire',
            'matricule.required' => 'Le matricule est obligatoire',
            'contact.required' => 'Le contact est obligatoire',
            'agence.required' => 'L\'agence est obligatoire',
            'imageCnibRecto.required' => 'Le CNIB Recto est obligatoire',
            'imageCnibVerso.required' => 'Le CNIB Verso est obligatoire',
        ];
    }
}
