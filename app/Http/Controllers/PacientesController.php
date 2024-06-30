<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Citas;
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
            return redirect()->route('verPacientes')->withSuccess("Paciente eliminado");
        } catch (\Exception $th) {
            return back()->withErrors(['error' => 'Hubo un problema al eliminar el paciente. Error: ' . $th->getMessage()]);
        }
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

        return view('pago', compact('citas'));
    }
}
