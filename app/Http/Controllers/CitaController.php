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
        try {
            Citas::create($request->validated());
            return redirect()->route('recepcionista')->with('success', 'Cita registrado correctamente');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Hubo un problema al insertar datos. Por favor, intentalo de nuevo']);
        }
    }
}
