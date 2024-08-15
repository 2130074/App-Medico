<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Paciente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $user = new User();

        $user->nombre = $request->nombre;
        $user->apellidos = $request->apellidos;
        $user->password = Hash::make($request->password);
        $user->correo = $request->correo;
        $user->telefono = $request->telefono;
        $user->area = $request->area;
        $user->tipoUsuario = $request->tipoUsuario;

        $user->save();

        return redirect(route('verUsuarios'))->with('success', 'Registro exitoso. Por favor, inicia sesión.');
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->only('correo', 'password');

        // Verificar si el correo y la contraseña son los de administrador
        if ($request->correo == 'admin@saludConecta.com' && $request->password == '12345') {
            return redirect(route('verUsuarios'));
        }

        // Intentar autenticación en la tabla de usuarios
        if (Auth::attempt(['correo' => $credentials['correo'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            $usuario = User::where('correo', $request->correo)->first();

            if ($usuario->tipoUsuario === 'Recepcionista') {
                return redirect(route('recepcionista.index'));
            } elseif ($usuario->tipoUsuario === 'Doctor') {
                return redirect(route('doctor.index'));
            } else {
                return back()->withErrors([
                    'correo' => 'No se pudo determinar el tipo de usuario.',
                ])->withInput();
            }
        }

        // Intentar autenticación en la tabla de pacientes
        $paciente = Paciente::where('correo', $credentials['correo'])->first();
        if ($paciente && Hash::check($credentials['password'], $paciente->password)) {
            Auth::guard('paciente')->login($paciente);
            $request->session()->regenerate();
            return redirect(route('paciente.perfil')); // Redirigir a la ruta correcta
        }

        // Intentar autenticación en la tabla de doctor
        $doctor = Doctor::where('correo', $credentials['correo'])->first();
        if ($doctor && Hash::check($credentials['password'], $doctor->password)) {
            Auth::guard('doctor')->login($doctor);
            $request->session()->regenerate();
            return redirect()->route('inicioDocColab'); // Redirigir a la ruta correcta
        }


        // Si la autenticación falla en ambas tablas
        return back()->withErrors([
            'correo' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
