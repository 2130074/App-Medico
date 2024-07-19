<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class VerServiciosController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        return view('verServicios', compact('servicios'));
    }

    public function edit(Servicio $servicio)
    {
        return view('modificarServicio', compact('servicio'));
    }

    public function update(Request $request, Servicio $servicio)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'duracion' => 'required',
        ]);

        $servicio->update($validatedData);
        return redirect()->route('verServicios')->withSuccess("Servicio actualizado exitosamente");
    }
}
