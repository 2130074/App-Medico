<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCitaRequest;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Servicio;
use App\Models\Citas;

class CitaController extends Controller
{
    public function index()
    {
        return view('recepcionista', [
            'pacientes' => Paciente::latest()->get(),
            'servicios' => Servicio::latest()->get(),
        ]);
    }

    public function store(StoreCitaRequest $request){
            Citas::create($request->validated());
            return redirect()->route('recepcionista.index')->with('success', 'Cita registrado correctamente');
        
    }

    public function verPago($paciente_id)
    {
        $citas = Citas::where('id_paciente', $paciente_id)
                      ->where('fecha', '<', now()) 
                      ->with('tipo_servicio')  
                      ->get();

        return view('pago', compact('citas', 'paciente_id'));
    }

    public function eliminarPago(Request $request, $cita_id)
    {
        $cita = Citas::find($cita_id);
        if ($cita) {
            $cita->delete();
        }
        
        return redirect()->route('verPago', ['paciente_id' => $request->paciente_id])->with('success', 'Pago eliminado de la vista');
    }
}