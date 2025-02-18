<?php

namespace App\Http\Requests\clients\mesures;

use Illuminate\Foundation\Http\FormRequest;

class MesureAddRequest extends FormRequest
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
            'sexe' => ['required','in:'.implode(',',[env ('SEXE_MASCULIN'),env('SEXE_FEMININ')])],
        ];
    }

    public function messages ()
    {
        return [
            'sexe.required' => 'Le sexe est obligatoire',
            'sexe.in' => 'Le sexe est incorrect',
            ];
    }
}
