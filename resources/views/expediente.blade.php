<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Expediente</title>
</head>



<body style="background-image: url('img/fondo.jpg'); background-size: cover; background-position: center; height: 100vh; margin: 0; padding: 0;">
    <header class="flex justify-between items-center bg-opacity-75 bg-white p-4">
        <h1 class="text-2xl font-bold text-gray-800">SaludConecta</h1>
        <div class="flex items-center">
            <button class="text-blue-500 px-4 py-2 rounded">Catálogo de productos</button>
            <div class="ml-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="location.href='/'">Cerrar sesión</button>
            </div>
        </div>
    </header>

    <div class="flex items-center justify-center h-screen" style="margin-top: -75px;">
        <div class="bg-white bg-opacity-75 p-8 rounded-lg shadow-md w-full max-w-3xl">
            <h2 class="text-3xl font-bold text-blue-600 text-center mb-4">Expediente Medico</h2>
           
            <div class="flex-grow flex items-center justify-center mt-6">
                <div class="w-full max-w-xl bg-white bg-opacity-75 rounded-lg p-6">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-300">Fecha de la cita</th>
                                <th class="py-2 px-4 border-b border-gray-300">Más detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-300 text-center">12/08/2023</td>
                                <td class="py-2 px-4 border-b border-gray-300 text-center"><button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="location.href='/detallesCita'">ver detalles</button></td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-300 text-center">12/08/2023</td>
                                <td class="py-2 px-4 border-b border-gray-300 text-center"><button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"  onclick="location.href='/detallesCita'">ver detalles</button></td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-300 text-center">12/08/2023</td>
                                <td class="py-2 px-4 border-b border-gray-300 text-center"><button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"  onclick="location.href='/detallesCita'">ver detalles</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-span-2 flex justify-between mt-6">
                <button type="button"
                    style="margin-right: 16px;" 
                    class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Enviar expediente
                </button>
                <button type="button"
                    class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="location.href='/doctor'">
                    Regresar al inicio
                </button>
            </div>
        </div>
    </div>
</body>

</html>