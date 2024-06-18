<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Detalles Pacientes</title>
</head>

<body class="bg-gradient-to-r from-[#4CA9DF] to-[#292E91]">
    <div class="flex h-screen">
        <div class="bg-blue-300 text-white w-1/5 p-6 flex flex-col justify-between shadow-xl">
            <div>
                <div class="flex items-center mb-8">
                    <img src="img/logo.png" alt="Logo" class="w-8 h-8 mr-2">
                    <span class="text-2xl font-bold">Salud Conecta</span>
                </div>
                <ul>
                    <li class="flex items-center mb-10">
                        <img src="img/calendario.png" alt="Registrar Icon" class="w-6 h-6 mr-2">
                        <a href="/doctor" class="text-lg">Agenda</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="img/usuario.png" alt="Ver Usuarios Icon" class="w-6 h-6 mr-2">
                        <a href="/docPacientes" class="text-lg">Ver pacientes</a>
                    </li>
                </ul>
            </div>
            <button
                class="w-full flex justify-center py-2 px-2 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                onclick="location.href='/'">
                Cerrar sesión
            </button>
        </div>

        <div class="flex items-center justify-center w-3/4 ml-auto">
            <div class="bg-white bg-opacity-10 p-8 md:p-10 rounded-lg shadow-xl w-full max-w-xl">
                <h2 class="text-3xl font-bold text-white text-center mb-4">Expediente Medico</h2>

                <div class="flex-grow flex items-center justify-center mt-6">
                    <table class="min-w-full bg-white bg-opacity-10 rounded-lg shadow-xl text-white">
                        <thead>
                            <tr class="bg-blue-500">
                                <th class="py-2 px-4 text-left">Fecha cita</th>
                                <th class="py-2 px-4 text-left">Más detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-blue-600">
                                <td class="py-2 px-4 text-center">20/05/2024</td>
                                <td class="py-2 px-4 text-center">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" onclick="location.href='/detallesCita'">Ver
                                        detalles</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-600">
                                <td class="py-2 px-4 text-center">20/05/2024</td>
                                <td class="py-2 px-4 text-center">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" onclick="location.href='/detallesCita'">Ver
                                        detalles</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-600">
                                <td class="py-2 px-4 text-center">20/05/2024</td>
                                <td class="py-2 px-4 text-center">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" onclick="location.href='/detallesCita'">Ver
                                        detalles</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-span-2 flex justify-between mt-6">
                    <button type="button" style="margin-right: 16px;"
                        class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="location.href='/detallesPacientes'">
                        Regresar
                    </button>
                    <button type="button"
                        class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        onclick="location.href='/docPacientes'">
                        Regresar al inicio
                    </button>
                </div>
            </div>
        </div>
    </div>


</body>

</html>

