<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enfermera;

class EnfermeraController extends Controller
{
    public function index()
    {
        $enfermeras = Enfermera::all();
        return view('admin.Enfermera', compact('enfermeras'));
    }

    public function registroEnfermera(Request $request)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:100',
            'sueldo' => 'required|numeric|min:0',
        ]);

        $nurse = new Enfermera();
        $nurse->nombre_completo = $request->nombre_completo;
        $nurse->sueldo = $request->sueldo;

        $nurse->save();

        return redirect()->route('Enfermera.index')->with('success', 'Enfermera registrada exitosamente.');
    }

    public function destroy($id)
    {
        $enfermera = Enfermera::find($id);
        if ($enfermera) {
            $enfermera->delete();
            return redirect()->route('Enfermera.index')
                ->with('success', 'Enfermera eliminada exitosamente.');
        }
        return redirect()->route('Enfermera.index')
            ->with('error', 'No se pudo encontrar la enfermera.');
    }

    public function edit($id)
    {
        $enfermera = Enfermera::findOrFail($id);
        return view('admin.modificarEnfermera', compact('enfermera'));
    }

    public function update(Request $request, $id)
    {
        $enfermera = Enfermera::findOrFail($id);
        $data = $request->validate([
            'nombre_completo' => 'required',
            'sueldo' => 'required|numeric|min:0',
        ]);

        $enfermera->update($data);

        return redirect()->route('Enfermera.index')->with('success', 'Enfermera actualizada exitosamente.');
    }
}