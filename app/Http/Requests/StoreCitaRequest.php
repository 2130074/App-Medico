<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCitaRequest extends FormRequest
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
            'motivos' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'id_paciente' => 'required|integer',
            'id_servicio' => 'required|integer',
        ];
    }
}
