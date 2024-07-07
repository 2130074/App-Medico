<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServicioRequest;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ServiciosDoctorController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        return view('doc.docServicios', compact('servicios'));
    }

    public function edit(Servicio $servicio)
    {
        return view('doc.modificarServicioDoc', compact('servicio'));
    }

    public function update(Request $request, Servicio $servicio)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'duracion' => 'required',
        ]);

        $servicio->update($validatedData);
        return redirect()->route('docServicios')->withSuccess("Servicio actualizado exitosamente");
    }


    public function destroy(Servicio $servicio)
    {
        try {
            $servicio->delete();
            return redirect()->route('docServicios')->withSuccess("Servicio eliminado");
        } catch (\Exception $th) {
            return back()->withErrors(['error' => 'Hubo un problema al eliminar el servicio. Error: ' . $th->getMessage()]);
        }
    }

    public function store(StoreServicioRequest $request)

    {
        try {
            Servicio::create($request->validated());
            return redirect()->route('docServicios')->with('success', 'Servicio registrado correctamente');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Hubo un problema al insertar datos. Por favor, intentalo de nuevo']);
        }
    }
}
