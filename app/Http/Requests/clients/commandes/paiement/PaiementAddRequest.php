<?php

namespace App\Http\Requests\clients\commandes\paiement;

use Illuminate\Foundation\Http\FormRequest;

class PaiementAddRequest extends FormRequest
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
            'date_paiement' => 'required',
            'montant' => 'required',
            'mode_paiement' => 'required',
        ];
    }

    public function messages ()
    {
        return [
            'date_paiement.required' => 'Le date de paiement est obligatoire',
            'montant.required' => 'Le montant est obligatoire',
            'mode_paiement.required' => 'Le mode de paiement est obligatoire',
        ];
    }
}
