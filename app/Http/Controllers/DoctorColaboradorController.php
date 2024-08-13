<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DoctorColaboradorController extends Controller
{
    public function index()
    {
        $doctores = Doctor::all();
        return view('admin.DoctorColaborador', compact('doctores'));
    }

    public function registroDoctor(Request $request)
    {
        $doctor = new Doctor();
        $doctor->nombre_completo = $request->nombre_completo;
        $doctor->correo = $request->correo;
        $doctor->password = Hash::make($request->password);
        $doctor->telefono = $request->telefono;

        $doctor->save();

        return redirect()->route('DoctorColaborador.index')->with('success', 'Doctor registrado exitosamente.');
    }

    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        if ($doctor) {
            $doctor->delete();
            return redirect()->route('DoctorColaborador.index')
                ->with('success', 'Usuario eliminado exitosamente.');
        }
        return redirect()->route('DoctorColaborador.index')
            ->with('error', 'No se pudo encontrar el usuario.');
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.modificarDoctor', compact('doctor'));
    }


    public function update(Request $request, $id)
    {
        $usuario = Doctor::findOrFail($id);

        $data = $request->validate([
            'nombre_completo' => 'required',
            'password' => 'nullable|string|min:4',
            'correo' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $usuario->update($data);

        return redirect()->route('DoctorColaborador.index')->with('success', 'Usuario actualizado exitosamente.');
    }
}
