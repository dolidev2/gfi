<?php

namespace App\Http\Requests\clients\tissus;

use Illuminate\Foundation\Http\FormRequest;

class TissuAddRequest extends FormRequest
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
            'nom' => ['required', 'string', 'max:255'],
            'images' =>[ 'image', 'max:5120'],
        ];
    }

    public function messages ()
    {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'nom.string' => 'Le nom doit être une chaîne de caractères',
            'nom.max' => 'Le nom doit faire moins de 255 caractères',
            'images.image' => 'Le format de fichier est incorrect',
            'images.max' => 'La taille du fichier est trop grande',
            ];
    }
}
