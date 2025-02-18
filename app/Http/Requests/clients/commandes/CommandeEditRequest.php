<?php

namespace App\Http\Requests\clients\commandes;

use Illuminate\Foundation\Http\FormRequest;

class CommandeEditRequest extends FormRequest
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
            'date_created_up' => 'required',
            'date_rdv_up' => 'required',
            'statut' => 'required|string',
        ];
    }

    public function messages ()
    {
        return [
            'date_rdv_up.required' => 'Le date de RDV est obligatoire',
            'date_created_up.required' => 'La date de création est obligatoire',
            'statut.required' => 'Le statut de la commande est obligatoire',
        ];
    }
}
