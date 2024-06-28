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

    public function destroy(Paciente $paciente)
    {
        try {
            $paciente->delete();
            return redirect()->route('verPacientes.index')->withSuccess("Paciente eliminado");
        } catch (\Exception $th) {
            return back()->withErrors(['error' => 'Hubo un problema al eliminar el paciente. Error: ' . $th->getMessage()]);
        }
    }
}

