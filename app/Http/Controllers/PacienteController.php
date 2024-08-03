<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Citas;
use App\Models\Servicio;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    public function registerPatient(Request $request)
    {
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
        return view('paciente.perfil', [
            'pacientes' => Paciente::latest()->get(),
            'servicios' => Servicio::latest()->get(),
            'citas' => $citas,
        ]);
    }

    public function showProfile()
    {
        // Obtiene al paciente autenticado
        $paciente = Auth::guard('paciente')->user();

        // Verifica si el paciente está autenticado
        if (!$paciente) {
            return redirect()->route('login')->withErrors('Debe iniciar sesión para acceder a esta página.');
        }

        // Obtener las citas del paciente autenticado
        $citas = $paciente->citas;

        // Pasar el paciente y sus citas a la vista
        return view('paciente.perfil', compact('paciente', 'citas'));
    }
}
