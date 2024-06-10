<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Ver Pago</title>
</head>

<body
    style="background-image: url('img/fondo.jpg'); background-size: cover; background-position: center; height: 100vh; margin: 0; padding: 0;">
    <header class="flex justify-between items-center bg-opacity-75 bg-white p-4">
        <h1 class="text-2xl font-bold text-gray-800">SaludConecta</h1>
        <a href="{{ route('logout') }}"><button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cerrar sesión</button></a>
    </header>

    <div class="flex justify-center mt-6">
        <div class="relative w-2/3 max-w-2xl">
            <input type="text" placeholder="Buscar"
                class="w-full py-2 pl-4 pr-10 border border-blue-500 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            <svg class="absolute right-3 top-2.5 w-5 h-5 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35M16.44 11.2a5.45 5.45 0 11-10.89 0 5.45 5.45 0 0110.89 0z" />
            </svg>
        </div>
    </div>

    <div class="flex justify-center mt-6">
        <div class="bg-white bg-opacity-75 p-8 rounded-lg shadow-md w-full max-w-3xl">
            <h2 class="text-3xl font-bold text-blue-600 text-center mb-4">Detalles del pago</h2>

            <div class="flex-grow flex items-center justify-center mt-6">
                <div class="w-full max-w-xl bg-white bg-opacity-75 rounded-lg p-6">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-300">Servicio</th>
                                <th class="py-2 px-4 border-b border-gray-300">Costo</th>
                                <th class="py-2 px-4 border-b border-gray-300">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-300">Consulta General</td>
                                <td class="py-2 px-4 border-b border-gray-300 text-center">$50.00</td>
                                <td class="py-2 px-4 border-b border-gray-300 text-center">12/08/2023</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-300">Examen de Sangre</td>
                                <td class="py-2 px-4 border-b border-gray-300 text-center">$30.00</td>
                                <td class="py-2 px-4 border-b border-gray-300 text-center">20/05/2024</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-300">Radiografía</td>
                                <td class="py-2 px-4 border-b border-gray-300 text-center">$40.00</td>
                                <td class="py-2 px-4 border-b border-gray-300 text-center">25/07/2024</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-end">
                <h3 class="text-xl font-bold text-gray-800">Total: <span class="text-blue-500">$120.00</span></h3>
            </div>

            <div class="flex justify-end mt-6">
                <button type="button"
                    class=" flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    onclick="location.href='/recepcionista'">
                    Regresar
                </button>
            </div>
        </div>
    </div>
</body>

</html>
