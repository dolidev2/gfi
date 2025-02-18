<?php

namespace App\Http\Requests\clients\commandes;

use Illuminate\Foundation\Http\FormRequest;

class CommandeAddRequest extends FormRequest
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
            'date_created' => 'required',
            'date_rdv' => 'required',
            'numero_commande' => 'required|string'
        ];
    }

    public function messages ()
    {
        return [
            'date_rdv.required' => 'Le date de RDV est obligatoire',
            'date_created.required' => 'La date de création est obligatoire',
            'numero_commande.required' => 'Le numéro de commande est obligatoire'
        ];
    }
}
