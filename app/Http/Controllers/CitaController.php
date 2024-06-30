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
}