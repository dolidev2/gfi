<?php

namespace App\Http\Requests\clients\commandes\paiement;

use Illuminate\Foundation\Http\FormRequest;

class PaiementEditRequest extends FormRequest
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
            'date_paiement_up' => 'required',
            'montant_up' => 'required',
            'mode_paiement_up' => 'required',
        ];
    }
    public function messages ()
    {
        return [
            'date_paiement_up.required' => 'Le date de paiement est obligatoire',
            'montant_up.required' => 'Le montant est obligatoire',
            'mode_paiement_up.required' => 'Le mode de paiement est obligatoire',
        ];
    }
}
