<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('verUsuarios', compact('usuarios'));
    }

    public function destroy($id)
    {
        $usuario = User::find($id);
        if ($usuario) {
            $usuario->delete();
            return redirect()->route('verUsuarios')
                ->with('success', 'Usuario eliminado exitosamente.');
        }
        return redirect()->route('verUsuarios')
            ->with('error', 'No se pudo encontrar el usuario.');
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('modificar', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $data = $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'password' => 'nullable',
            'correo' => 'required|email',
            'telefono' => 'nullable',
            'area' => 'nullable',
            'tipoUsuario' => 'required',
        ]);

        $usuario->update($data);

        return redirect()->route('verUsuarios')->with('success', 'Usuario actualizado exitosamente.');
    }
}
