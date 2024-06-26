<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacientesController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::all();
        return view('verPacientes', compact('pacientes'));
    }

    public function destroy($id)
    {
        $paciente = Paciente::find($id); 
        if ($paciente) {
            $paciente->delete(); 
            return redirect()->route('verPacientes') 
                ->with('success', 'Paciente eliminado exitosamente.');
        }
        return redirect()->route('verPacientes') 
            ->with('error', 'No se pudo encontrar el paciente.');
    }
}

