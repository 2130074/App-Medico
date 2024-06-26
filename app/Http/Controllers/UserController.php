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
}
