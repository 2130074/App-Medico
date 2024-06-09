<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Registro Usuarios</title>
</head>


<body
    style="background-image: url('img/fondo.jpg'); background-size: cover; background-position: center; height: 100vh; margin: 0; padding: 0;">
    <header class="flex justify-between items-center bg-opacity-75 bg-white p-4">
        <h1 class="text-2xl font-bold text-gray-800">SaludConecta</h1>
    </header>

    <div class="flex items-center justify-center h-screen" style="margin-top: -65px;">
        <div class="bg-white bg-opacity-75 p-8 md:p-10 rounded-lg shadow-xl flex flex-col items-center w-full max-w-2xl"> 
            <h2 class="text-3xl font-bold text-blue-500">Registro</h2>
            <form class="mt-6 w-full grid grid-cols-2 gap-4" action="{{ route('validar-registro') }}" method="POST">
                @csrf
                <div>
                    <label for="nombres" class="block text-sm font-medium text-gray-700">Nombre(s)</label>
                    <input type="text" name="nombre" id="nombre"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                </div>
                <div>
                    <label for="apellidos" class="block text-sm font-medium text-gray-700">Apellidos(s)</label>
                    <input type="text" name="apellidos" id="apellidos"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                </div>
                <div>
                    <label for="tipo_usuario" class="block text-sm font-medium text-gray-700">Tipo usuarios</label>
                    <select name="tipoUsuario" id="tipoUsuario"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                        <option value="">Seleccione una opción</option>
                        <option value="recepcionista">Recepcionista</option>
                        <option value="doctor">Doctor</option>
                    </select>
                </div>
                <div>
                    <label for="area" class="block text-sm font-medium text-gray-700">Área</label>
                    <input type="text" name="area" id="area"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                </div>
                <div>
                    <label for="contrasena" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input type="password" name="password" id="password"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                </div>
                <div>
                    <label for="confirmar_contrasena" class="block text-sm font-medium text-gray-700">Confirmar
                        contraseña</label>
                    <input type="password" name="confirmar_contrasena" id="confirmar_contrasena"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                </div>
                <div>
                    <label for="correo" class="block text-sm font-medium text-gray-700">Correo</label>
                    <input type="email" name="correo" id="correo"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                </div>
                <div>
                    <label for="telefono" class="block text-sm font-medium text-gray-700">Número de teléfono</label>
                    <input type="tel" name="telefono" id="telefono"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                </div>

                <div class="col-span-2 flex justify-between mt-6">
                    <button type="submit"
                        style="margin-right: 16px;" 
                        class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Registrar
                    </button>
                    <button type="button"
                        class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="location.href='/'">
                        Regresar
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>