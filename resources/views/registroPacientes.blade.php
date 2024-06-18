<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Registro Pacientes</title>
</head>


<body class="bg-gradient-to-r from-[#4CA9DF] to-[#292E91]">
    <div class="flex h-screen">
        <div class="bg-blue-400 text-white w-1/5 p-6 flex flex-col justify-between shadow-xl">
            <div>
                <div class="flex items-center mb-8">
                    <img src="img/logo.png" alt="Logo" class="w-8 h-8 mr-2">
                    <span class="text-2xl font-bold">Salud Conecta</span>
                </div>
                <ul>
                    <li class="flex items-center mb-10">
                        <img src="img/calendario.png" alt="Registrar Icon" class="w-6 h-6 mr-2">
                        <a href="/recepcionista" class="text-lg">Agenda</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="img/calendario.png" alt="Registrar Icon" class="w-6 h-6 mr-2">
                        <a href="/servicios" class="text-lg">Agregar servicio</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="img/calendario.png" alt="Registrar Icon" class="w-6 h-6 mr-2">
                        <a href="/registroPacientes" class="text-lg">Agregar paciente</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="img/usuario.png" alt="Ver Usuarios Icon" class="w-6 h-6 mr-2">
                        <a href="/verPacientes" class="text-lg">Ver pacientes</a>
                    </li>
                </ul>
            </div>
            <button
                    class="w-full flex justify-center py-2 px-2 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    onclick="location.href='/'">
                    Cerrar sesión
            </button>
        </div>
    </div>
    
    <div class="flex items-center justify-center h-screen" style="margin-top: -68px;">
        <div class="bg-white bg-opacity-75 p-8 md:p-10 rounded-lg shadow-xl flex flex-col items-center w-full max-w-2xl"> 
            <h2 class="text-3xl font-bold text-blue-500">Registro nuevos pacientes</h2>
            <form class="mt-6 w-full grid grid-cols-2 gap-4" action="{{ route('registrar-pacientes') }}" method="POST">
                @csrf
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre(s)</label>
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
                
                <div class="col-span-2">
                    <label for="enfermedades" class="block text-sm font-medium text-gray-700">Enfermedades crónicas que padece</label>
                    <input type="text" name="enfermedades" id="enfermedades"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="col-span-2">
                    <label for="alergias" class="block text-sm font-medium text-gray-700">Alergias</label>
                    <input type="text" name="alergias" id="alergias"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="col-span-2 flex space-x-4 justify-between">
                    <div class="flex-1">
                        <label for="altura" class="block text-sm font-medium text-gray-700">Altura</label>
                        <input type="text" name="altura" id="altura"
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="flex-1 ml-4">
                        <label for="peso" class="block text-sm font-medium text-gray-700">Peso</label>
                        <input type="text" name="peso" id="peso"
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="flex-1 ml-4">
                        <label for="edad" class="block text-sm font-medium text-gray-700">Edad</label>
                        <input type="text" name="edad" id="edad"
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="flex-1 ml-4">
                        <label for="genero" class="block text-sm font-medium text-gray-700">Género</label>
                        <select name="genero" id="genero"
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                            <option value="prefiero-no-especificar">Prefiero no especificar</option>
                        </select>
                    </div>
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
                        class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 " onclick="location.href='/recepcionista'">
                        Regresar
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>