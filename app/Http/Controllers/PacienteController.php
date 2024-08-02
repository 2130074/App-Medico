<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCitaRequest;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Citas;
use App\Models\Servicio;
use Illuminate\Support\Facades\Hash;

class PacienteController extends Controller{
    public function registerPatient(Request $request){
        $paciente = new Paciente();

        $paciente->nombre = $request->nombre;
        $paciente->apellidos = $request->apellidos;
        $paciente->edad = $request->edad;
        $paciente->genero = $request->genero;
        $paciente->altura = $request->altura;
        $paciente->peso = $request->peso;
        $paciente->enfermedades = $request->enfermedades;
        $paciente->alergias = $request->alergias;
        $paciente->telefono = $request->telefono;
        $paciente->correo = $request->correo;
        $paciente->password = Hash::make($request->password);

        $paciente->save();

        return redirect(route('login'));
    }

    public function index()
    {
        $citas = Citas::with('servicio')->get();  
        return view('paciente.calendario', [
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
            return redirect()->route('calendario.index')
                ->with('error', 'Ya existe una cita registrada en la misma fecha y hora.');
        }

        Citas::create($request->validated());

        return redirect()->route('calendario.index')->with('success', 'Cita registrada correctamente');
    }
}