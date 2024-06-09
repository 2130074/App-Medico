<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Paciente;
use App\Models\Tipo_servicio;

use Illuminate\Http\Request;

class CitasController extends Controller{
    public function registrarCita(Request $request){
        $request->validate([
            'fechaHora' => 'required|date_format:Y-m-d\TH:i',
            'nombre' => 'required|string',
            'tipoServicio' => 'required|string'
        ]);

        $cita = new Citas();

        $cita->motivos = $request->motivos;
        $cita->fechaHora = $request->fechaHora;

        // Buscamos al paciente por su nombre
        $paciente = Paciente::where('nombre', $request->nombre)->firstOrFail();
        $cita->paciente()->associate($paciente);

        // Buscamos el tipo de servicio por su nombre
        $tipoServicio = Tipo_servicio::where('tipo', $request->tipoServicio)->firstOrFail();
        $cita->tipo_servicio()->associate($tipoServicio);

        $cita->save();
        
        return redirect()->route('recepcionista')->with('success', 'Cita registrada exitosamente');
    }
}