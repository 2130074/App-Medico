<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServicioController extends Controller
{
    // Mostrar el formulario de registro de servicios
    public function create()
    {
        return view('servicios.create');
    }

    // Almacenar el servicio en la base de datos
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:50',
            'precio' => 'required|numeric|min:0',
            'time' => 'required|string',
            'id_tipo_servicio' => 'nullable|exists:tipo_servicios,id' // Validación opcional
        ]);

        // Crear un nuevo servicio
        $servicio = new Servicio();
        $servicio->nombre = $validated['nombre'];
        $servicio->precio = $validated['precio'];
        $servicio->id_tipo_servicio = $validated['id_tipo_servicio'] ?? null; // Permitir nulo
        $servicio->save();

        // Redirigir a la vista de recepcionista con un mensaje de éxito
        return redirect()->route('recepcionista')->with('success', 'Servicio registrado correctamente');
    }
}
