<?php

namespace App\Http\Requests\outils\modele;

use Illuminate\Foundation\Http\FormRequest;

class ModeleEditRequest extends FormRequest
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
            'nom' => 'required|string',
            'prix' => 'required|numeric',
            'cout_montage' => 'required|numeric',
            'cout_decoupage' => 'required|numeric',
        ];
    }

    public function messages ()
    {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'nom.string' => 'Le nom doit être une chaîne de caractères',
            'prix.required' => 'Le prix est obligatoire',
            'prix.numeric' => 'Le prix doit être un nombre',
            'cout_montage.required' => 'Le cout montage est obligatoire',
            'cout_montage.numeric' => 'Le cout montage doit être un nombre',
            'cout_decoupage.required' => 'Le cout découpage est obligatoire',
            'cout_decoupage.numeric' => 'Le cout découpage doit être un nombre',
        ];
    }
}
