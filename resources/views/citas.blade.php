<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Citas</title>
</head>

<body style="background-image: url('img/fondo.jpg'); background-size: cover; background-position: center; height: 100vh; margin: 0; padding: 0;">
    <header class="flex justify-between items-center bg-opacity-75 bg-white p-4">
        <h1 class="text-2xl font-bold text-gray-800">SaludConecta</h1>
        <a href="{{ route('logout') }}"><button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cerrar sesión</button></a>
    </header>

    <div class="flex-grow flex items-center justify-center mt-20">
        <div class="bg-opacity-75 bg-white p-4 md:p-10 rounded-lg shadow-xl flex flex-col items-center w-full max-w-md">
            <h2 class="text-4xl font-bold mt-6 text-blue-600 hover:text-blue-500">Registro citas</h2>
            <form class="mt-6 w-full" action="{{ route('registrar-cita') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del paciente</label>
                    <input type="text" name="nombre" id="nombre"
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           required>
                </div>

                <div class="mb-4">
                    <label for="motivos" class="block text-sm font-medium text-gray-700">Motivo de la cita</label>
                    <input type="text" name="motivos" id="motivos"
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           required>
                </div>

                <div class="mb-4">
                    <label for="tipoServicio" class="block text-sm font-medium text-gray-700">Tipo de servicio</label>
                    <input type="text" name="tipoServicio" id="tipoServicio"
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           required>
                </div>

                <div class="mb-4">
                    <label for="fechaHora" class="block text-sm font-medium text-gray-700">Fecha y hora</label>
                    <input type="datetime-local" name="fechaHora" id="fechaHora"
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           required>
                </div>
    
                <div class="flex-grow flex items-center justify-center mt-6">
                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Agendar
                    </button>
                </div>

                <div class="flex-grow flex items-center justify-center mt-6">
                    <button type="button" 
                        class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="location.href='/recepcionista'">
                        Regresar
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>