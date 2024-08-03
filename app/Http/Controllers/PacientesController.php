<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Citas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PacientesController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::with(['citas' => function($query) {
            $query->where('fecha', '>=', now())->orderBy('fecha')->orderBy('hora');
        }])->get();

        return view('verPacientes', compact('pacientes'));
    }

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

        return redirect(route('verPacientes'));
    }

    public function edit(Paciente $paciente)
    {
        return view('modificarPacientes', compact('paciente'));
    }

    public function update(Request $request, $id)
    {

        $paciente = Paciente::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
        ]);

        $paciente->fill($validatedData)->save();
        return redirect()->route('verPacientes')->with('success', 'Paciente actualizado exitosamente.');
    }

    public function verPagos($id)
    {
        $citas = Citas::where('id_paciente', $id)
            ->with('tipo_servicio')
            ->get();

        return view('pago', compact('citas', 'id')); 
    }
}
