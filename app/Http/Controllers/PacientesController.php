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
    public function edit(Paciente $paciente)
    {
        return view('modificarPacientes', compact('paciente'));
    }

    public function update(Request $request, $id)
{
    // Primero, busca el paciente por ID
    $paciente = Paciente::findOrFail($id); // Utiliza findOrFail para lanzar una excepción si el paciente no existe

    // Luego, valida los datos del formulario
    $validatedData = $request->validate([
        'nombre' => 'required',
        'apellidos' => 'required',
        // Continúa agregando las reglas de validación para los demás campos
    ]);

    $paciente->fill($validatedData)->save(); 
    return redirect()->route('verPacientes')->with('success', 'Paciente actualizado exitosamente.');
}

}
