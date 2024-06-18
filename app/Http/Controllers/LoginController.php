<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        // Validar los datos
        /*$request->validate([
            'correo' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);*/

        $user = new User();

        $user->nombre = $request->nombre;
        $user->apellidos = $request->apellidos;
        $user->password = $request->password;
        $user->correo = $request->correo;
        $user->telefono = $request->telefono;
        $user->area = $request->area;
        $user->tipoUsuario = $request->tipoUsuario;

        $user->save();

        //Auth::login($user);
        //Auth::logout();

        return redirect(route('login'))->with('success', 'Registro exitoso. Por favor, inicia sesión.');
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->only('correo', 'password');
    
        // Verificar si el correo y la contraseña son los de administrador
        if ($request->correo == 'admin@saludConecta.com' && $request->password == '12345') {
            // Redirigir al usuario a la vista de registroUsuarios
            return redirect(route('admin'));
        }
    
        // Intentar autenticar con las credenciales proporcionadas
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            // Buscar al usuario por correo
            $usuario = User::where('correo', $request->correo)->first();
    
            // Verificar si el usuario existe
            if (!$usuario) {
                // Manejar el caso en que el usuario no se encuentra
                return back()->withErrors([
                    'correo' => 'El usuario no se encontró.',
                ])->withInput();
            }

            if ($usuario->tipoUsuario === 'Recepcionista') {
                return redirect(route('recepcionista'));
            } elseif ($usuario->tipoUsuario === 'Doctor') {
                return redirect(route('doctor'));
            } else {
                // Manejar otros casos, como usuarios sin tipo asignado
                return back()->withErrors([
                    'correo' => 'No se pudo determinar el tipo de usuario.',
                ])->withInput();
            }
        } else {
            // Si las credenciales no son correctas, mostrar un error
            return back()->withErrors([
                'correo' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
            ])->withInput();
        }
    }
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
