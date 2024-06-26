<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServicioController extends Controller
{
    public function create()
    {
        return view('servicios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:50',
            'precio' => 'required|numeric|min:0',
            'time' => 'required|string',
            'id_tipo_servicio' => 'nullable|exists:tipo_servicios,id' 
        ]);

        //Registra un nuevo servicio
        $servicio = new Servicio();
        $servicio->nombre = $validated['nombre'];
        $servicio->precio = $validated['precio'];
        $servicio->id_tipo_servicio = $validated['id_tipo_servicio'] ?? null; //perimite que el usuario ingrese datos nulos
        $servicio->save();

        //Si si lo registra envia a la ventana de recepcionista 
        return redirect()->route('recepcionista')->with('success', 'Servicio registrado correctamente');
    }
}
