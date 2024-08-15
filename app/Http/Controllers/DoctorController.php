<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCitaRequest;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Producto;
use App\Models\Servicio;
use App\Models\Doctor;
use App\Models\Citas;

class DoctorController extends Controller
{
    public function index()
    {
        $citas = Citas::with('servicio')->get();  
        return view('doctor', [
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
            return redirect()->route('doctor.index')
                ->with('error', 'Ya existe una cita registrada en la misma fecha y hora.');
        }

        Citas::create($request->validated());

        return redirect()->route('doctor.index')->with('success', 'Cita registrada correctamente');
    }

    public function detallesCita($id)
    {
        $cita = Citas::with('tipo_servicio')->find($id);
    
        if (!$cita) {
            return redirect()->back()->with('error', 'Cita no encontrada.');
        }
    
        $productos = Producto::all();
        $servicio = $cita->tipo_servicio;
    
        return view('detallesCita', compact('cita', 'productos', 'servicio'));
    }
}
