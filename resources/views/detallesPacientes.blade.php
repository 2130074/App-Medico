<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Detalles del paciente</title>
</head>


<body style="background-image: url('img/fondo.jpg'); background-size: cover; background-position: center; height: 100vh; margin: 0; padding: 0;">
    <header class="flex justify-between items-center bg-opacity-75 bg-white p-4">
        <h1 class="text-2xl font-bold text-gray-800">SaludConecta</h1>
        <div class="flex items-center">
            <button class="text-blue-500 px-4 py-2 rounded">Catálogo de productos</button>
            <div class="ml-4">
                <a href="{{ route('logout') }}"><button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cerrar sesión</button></a>
            </div>
        </div>
    </header>

    <div class="flex items-center justify-center h-screen" style="margin-top: -75px;">
        <div class="bg-white bg-opacity-75 p-8 rounded-lg shadow-md w-full max-w-3xl">
            <h2 class="text-3xl font-bold text-blue-600 text-center mb-4">Detalles del paciente</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-2">
                    <label class="block font-medium text-blue-600">Nombre(s):</label>
                    <p class="text-gray-900">Luisana Guadalupe</p>
                </div>
                <div class="mb-2">
                    <label class="block font-medium text-blue-600">Apellidos(s):</label>
                    <p class="text-gray-900">Rodriguez Salas</p>
                </div>
                <div class="mb-2">
                    <label class="block font-medium text-blue-600">Edad:</label>
                    <p class="text-gray-900">20</p>
                </div>
                <div class="mb-2">
                    <label class="block font-medium text-blue-600">Género:</label>
                    <p class="text-gray-900">Femenino</p>
                </div>
                <div class="mb-2">
                    <label class="block font-medium text-blue-600">Altura:</label>
                    <p class="text-gray-900">1.48</p>
                </div>
                <div class="mb-2">
                    <label class="block font-medium text-blue-600">Peso:</label>
                    <p class="text-gray-900">60kg</p>
                </div>
                <div class="mb-2">
                    <label class="block font-medium text-blue-600">Enfermedades crónicas que padece:</label>
                    <p class="text-gray-900">No aplica</p>
                </div>
                <div class="mb-2">
                    <label class="block font-medium text-blue-600">Alergias:</label>
                    <p class="text-gray-900">A la penicilina</p>
                </div>
                <div class="mb-2">
                    <label class="block font-medium text-blue-600">Teléfono:</label>
                    <p class="text-gray-900">834 149 4966</p>
                </div>
                <div class="mb-2">
                    <label class="block font-medium text-blue-600">Correo:</label>
                    <p class="text-gray-900">2130074@upv.edu.mx</p>
                </div>
            </div>
            <div class="col-span-2 flex justify-between mt-6">
                <button type="button"
                    style="margin-right: 16px;" 
                    class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="location.href='/expediente'">
                    Ver expediente
                </button>
                <button type="button"
                    class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"  onclick="location.href='/doctor'">
                    Regresar al inicio
                </button>
            </div>
        </div>
    </div>
</body>

</html>