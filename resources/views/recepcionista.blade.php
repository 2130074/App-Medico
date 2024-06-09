<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Bienvenida recepcionista</title>
</head>

<body style="background-image: url('img/fondo.jpg'); background-size: cover; background-position: center; height: 100vh; margin: 0; padding: 0;">
    <header class="flex justify-between items-center bg-opacity-75 bg-white p-4">
        <h1 class="text-2xl font-bold text-gray-800">SaludConecta</h1>
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="location.href='/'">Cerrar sesión</button>
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

    <div class="flex-grow flex items-center justify-center mt-6">
        <div class="w-full max-w-7xl bg-white bg-opacity-75 rounded-lg p-6">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-300">Nombre</th>
                        <th class="py-2 px-4 border-b border-gray-300">Correo</th>
                        <th class="py-2 px-4 border-b border-gray-300">Última cita</th>
                        <th class="py-2 px-4 border-b border-gray-300">Próxima cita</th>
                        <th class="py-2 px-4 border-b border-gray-300">Total de pago</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-300 whitespace-nowrap">Luisana Guadalupe</td>
                        <td class="py-2 px-4 border-b border-gray-300">luisanasalas2508@gmail.com</td>
                        <td class="py-2 px-4 border-b border-gray-300 text-center">12/08/2023</td>
                        <td class="py-2 px-4 border-b border-gray-300 text-center">20/05/2024</td>
                        <td class="py-2 px-4 border-b border-gray-300 text-center"><button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-60" onclick="location.href='/pago'">Ver pago</button></td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-300 whitespace-nowrap">Luisana Guadalupe</td>
                        <td class="py-2 px-4 border-b border-gray-300">luisanasalas2508@gmail.com</td>
                        <td class="py-2 px-4 border-b border-gray-300 text-center">12/08/2023</td>
                        <td class="py-2 px-4 border-b border-gray-300 text-center">20/05/2024</td>
                        <td class="py-2 px-4 border-b border-gray-300 text-center"><button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-60" onclick="location.href='/pago'">Ver pago</button></td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-300 whitespace-nowrap">Luisana Guadalupe</td>
                        <td class="py-2 px-4 border-b border-gray-300">luisanasalas2508@gmail.com</td>
                        <td class="py-2 px-4 border-b border-gray-300 text-center">12/08/2023</td>
                        <td class="py-2 px-4 border-b border-gray-300 text-center">20/05/2024</td>
                        <td class="py-2 px-4 border-b border-gray-300 text-center"><button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-60" onclick="location.href='/pago'">Ver pago</button></td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-end mt-4 space-x-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="location.href='/citas'">Agendar cita</button>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="location.href='/servicios'">Agendar servicio</button>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="location.href='/registroPacientes'">Registrar nuevo paciente</button>
            </div>
        </div>
    </div>
</body>
</html>
