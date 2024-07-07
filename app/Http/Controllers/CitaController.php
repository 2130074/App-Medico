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
        $citas = Citas::with('servicio')->get();  
        return view('recepcionista', [
            'pacientes' => Paciente::latest()->get(),
            'servicios' => Servicio::latest()->get(),
            'citas' => $citas,  
        ]);
    }

    public function store(StoreCitaRequest $request)
    {
        $existingCita = Citas::where('fecha', $request->fecha)
                             ->where('hora', $request->hora)
                             ->first();

        if ($existingCita) {
            return redirect()->route('recepcionista.index')
                ->with('error', 'Ya existe una cita registrada en la misma fecha y hora.');
        }

        Citas::create($request->validated());

        return redirect()->route('recepcionista.index')->with('success', 'Cita registrada correctamente');
    }


    public function verPago($paciente_id)
    {
        $citas = Citas::where('id_paciente', $paciente_id)
            ->with('tipo_servicio')
            ->get();

        return view('pago', compact('citas', 'paciente_id')); 
    }

    public function cambiarEstadoPago(Request $request, $cita_id)
    {
        $cita = Citas::findOrFail($cita_id);
        $cita->estado = ($cita->estado == 'Pendiente') ? 'Pagado' : 'Pendiente';
        $cita->save();

        return redirect()->route('verPago', $request->paciente_id)->with('success', 'Estado del pago actualizado.');
    }
}