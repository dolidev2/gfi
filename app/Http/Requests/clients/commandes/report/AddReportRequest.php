<?php

namespace App\Http\Requests\clients\commandes\report;

use Illuminate\Foundation\Http\FormRequest;

class AddReportRequest extends FormRequest
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
            'date_report' => 'required',
            'report_motif' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'date_report.required' => 'La date de report du rdv est obligatoire',
            'report_motif.required' => 'Le motif est obligatoire',
        ];
    }
}
