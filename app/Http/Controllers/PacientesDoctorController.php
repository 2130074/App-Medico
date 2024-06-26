<?php


namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacientesDoctorController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::all();
        return view('docPacientes', compact('pacientes'));
    }

    public function show($id)
    {
        $paciente = Paciente::findOrFail($id); 
        return view('detallesPacientes', compact('paciente')); 
    }
}
