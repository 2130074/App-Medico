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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicio $servicio)
    {
        return view('verServicios.modificarServicio', compact('servicio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servicio $servicio)
    {
        //
    }

    public function destroy(Servicio $servicio)
    {
        try {
            $servicio->delete();
            return redirect()->route('verServicios.index')->withSuccess("Servicio eliminado");
        } catch (\Exception $th) {
            return back()->withErrors(['error' => 'Hubo un problema al eliminar el servicio. Error: ' . $th->getMessage()]);
        }
    }
}
