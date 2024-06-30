<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Modificar</title>
</head>

<body class="bg-gradient-to-r from-[#4CA9DF] to-[#292E91]">
    <div class="flex h-screen">
        <div class="bg-blue-650 text-white w-1/5 p-6 flex flex-col justify-between shadow-xl">
            <div>
                <div class="flex items-center mb-8">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-8 h-8 mr-2">
                    <span class="text-2xl font-bold">Salud Conecta</span>
                </div>
                <ul>
                    <li class="flex items-center mb-10">
                        <img src="{{ asset('img/usuario.png') }}" alt="Registrar Icon" class="w-6 h-6 mr-2">
                        <a href="/registroUsuarios" class="text-lg">Registrar</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="{{ asset('img/usuario.png') }}" alt="Ver Usuarios Icon" class="w-6 h-6 mr-2">
                        <a href="/verUsuarios" class="text-lg">Ver usuarios</a>
                    </li>
                </ul>
            </div>
            <button
                class="w-full flex justify-center py-2 px-2 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"  onclick="location.href='/'">
                Cerrar sesión
            </button>
        </div>


        <div class="flex items-center justify-center w-3/4 ml-auto">
            <div class="bg-white bg-opacity-10 p-8 md:p-10 rounded-lg shadow-xl w-full max-w-sm">
                <h2 class="text-3xl font-bold text-white text-center mb-6">Modificación de usuarios</h2>
                <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                    @csrf
                    <div class="mb-4 flex items-center bg-white bg-opacity-20 rounded-md shadow-sm">
                        <img src="{{ asset('img/user.png') }}" alt="Nombre Icon" class="w-6 h-6 ml-2">
                        <input type="text" name="nombre" id="nombre"
                            class="flex-grow px-3 py-2 bg-transparent border-none rounded-md focus:outline-none focus:ring-0 text-white placeholder-white"
                            placeholder="Nombre(s)" value="{{ $usuario->nombre }}" required>
                    </div>
                    <div class="mb-4 flex items-center bg-white bg-opacity-20 rounded-md shadow-sm">
                        <img src="{{ asset('img/user.png') }}" alt="Apellidos Icon" class="w-6 h-6 ml-2">
                        <input type="text" name="apellidos" id="apellidos"
                            class="flex-grow px-3 py-2 bg-transparent border-none rounded-md focus:outline-none focus:ring-0 text-white placeholder-white"
                            placeholder="Apellidos(s)" value="{{ $usuario->apellidos }}" required>
                    </div>
                    <div class="mb-4 flex items-center bg-white bg-opacity-20 rounded-md shadow-sm">
                        <img src="{{ asset('img/user.png') }}" alt="Tipo Usuarios Icon" class="w-6 h-6 ml-2">
                        <select name="tipoUsuario" id="tipoUsuario" value="{{ $usuario->tipoUsuario }}"
                            class="flex-grow px-3 py-2 bg-transparent border-none rounded-md focus:outline-none focus:ring-0 text-white placeholder-white"
                            required>
                            <option value="">Seleccione una opción</option>
                            <option value="recepcionista">Recepcionista</option>
                            <option value="doctor">Doctor</option>
                        </select>
                    </div>
                    <div class="mb-4 flex items-center bg-white bg-opacity-20 rounded-md shadow-sm">
                        <img src="{{ asset('img/user.png') }}" alt="Área Icon" class="w-6 h-6 ml-2">
                        <input type="text" name="area" id="area" value="{{ $usuario->area}}"
                            class="flex-grow px-3 py-2 bg-transparent border-none rounded-md focus:outline-none focus:ring-0 text-white placeholder-white"
                            placeholder="Área" required>
                    </div>
                    <div class="mb-4 flex items-center bg-white bg-opacity-20 rounded-md shadow-sm">
                        <img src="{{ asset('img/candado.png') }}" alt="Contraseña Icon" class="w-6 h-6 ml-2">
                        <input type="password" name="password"
                            class="flex-grow px-3 py-2 bg-transparent border-none rounded-md focus:outline-none focus:ring-0 text-white placeholder-white"
                            placeholder="Contraseña" required>
                    </div>
                    <div class="mb-4 flex items-center bg-white bg-opacity-20 rounded-md shadow-sm">
                        <img src="{{ asset('img/candado.png') }}" alt="Confirmar Contraseña Icon" class="w-6 h-6 ml-2">
                        <input type="password" name="confirmar_contrasena" id="confirmar_contrasena"
                            class="flex-grow px-3 py-2 bg-transparent border-none rounded-md focus:outline-none focus:ring-0 text-white placeholder-white"
                            placeholder="Confirmar contraseña" required>
                    </div>
                    <div class="mb-4 flex items-center bg-white bg-opacity-20 rounded-md shadow-sm">
                        <img src="{{ asset('img/email.png') }}" alt="Correo Icon" class="w-6 h-6 ml-2">
                        <input type="email" name="correo" id="correo" value="{{ $usuario->correo}}"
                            class="flex-grow px-3 py-2 bg-transparent border-none rounded-md focus:outline-none focus:ring-0 text-white placeholder-white"
                            placeholder="Correo" required>
                    </div>
                    <div class="mb-4 flex items-center bg-white bg-opacity-20 rounded-md shadow-sm">
                        <img src="{{ asset('img/phone.png') }}" alt="Teléfono Icon" class="w-6 h-6 ml-2">
                        <input type="tel" name="telefono" id="telefono" value="{{ $usuario->telefono}}"
                            class="flex-grow px-3 py-2 bg-transparent border-none rounded-md focus:outline-none focus:ring-0 text-white placeholder-white"
                            placeholder="Número de teléfono" required>
                    </div>

                    <div class="flex-grow flex items-center justify-center mt-6">
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Actualizar
                        </button>
                    </div>
                    <div class="flex-grow flex items-center justify-center mt-3">
                        <button type="button"
                            class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="location.href='/verUsuarios'">
                            Regresar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>