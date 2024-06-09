<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Paciente;
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

        $paciente->save();

        return redirect(route('recepcionista'));
    }

    public function paciente(){
        return $this->belongsTo('App\Models\Paciente', 'id_paciente');
    }
}