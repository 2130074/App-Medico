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


    public function destroy(Servicio $servicio)
    {
        try {
            $servicio->delete();
            return redirect()->route('verServicios')->withSuccess("Servicio eliminado");
        } catch (\Exception $th) {
            return back()->withErrors(['error' => 'Hubo un problema al eliminar el servicio. Error: ' . $th->getMessage()]);
        }
    }
}
