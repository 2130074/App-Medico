<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServicioRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Permitir acceso a todos los usuarios autenticados
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:50',
            'precio' => 'required|numeric|min:0',
            'duracion' => 'required|integer|min:0',
        ];
    }
}
