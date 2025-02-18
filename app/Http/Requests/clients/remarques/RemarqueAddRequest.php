<?php

namespace App\Http\Requests\clients\remarques;

use Illuminate\Foundation\Http\FormRequest;

class RemarqueAddRequest extends FormRequest
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
            'commande_select_remarque' => ['required'],
            'remarque_description'=> ['required'],
        ];
    }

    public function messages ()
    {
        return [
            'commande_select_remarque.required' => 'La commande est obligatoire',
            'remarque_description.required' => 'Le commentaire est obligatoire',
        ];
    }
}
