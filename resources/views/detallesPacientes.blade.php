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
                        <a href="#" class="text-lg">Agenda</a>
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
                <h2 class="text-3xl font-bold  text-blue-800 text-center mb-4">Detalles del paciente</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block font-medium  text-blue-800">Nombre(s):</label>
                        <p class="text-gray-900">Luisana Guadalupe</p>
                    </div>
                    <div class="mb-2">
                        <label class="block font-medium   text-blue-800">Apellidos(s):</label>
                        <p class="text-gray-900">Rodriguez Salas</p>
                    </div>
                    <div class="mb-2">
                        <label class="block font-medium text-blue-800">Edad:</label>
                        <p class="text-gray-900">20</p>
                    </div>
                    <div class="mb-2">
                        <label class="block font-medium  text-blue-800">Género:</label>
                        <p class="text-gray-900">Femenino</p>
                    </div>
                    <div class="mb-2">
                        <label class="block font-medium text-blue-800">Altura:</label>
                        <p class="text-gray-900">1.48</p>
                    </div>
                    <div class="mb-2">
                        <label class="block font-medium text-blue-800">Peso:</label>
                        <p class="text-gray-900">60kg</p>
                    </div>
                    <div class="mb-2">
                        <label class="block font-medium text-blue-800">Enfermedades que padece:</label>
                        <p class="text-gray-900">No aplica</p>
                    </div>
                    <div class="mb-2">
                        <label class="block font-medium text-blue-800">Alergias:</label>
                        <p class="text-gray-900">A la penicilina</p>
                    </div>
                    <div class="mb-2">
                        <label class="block font-medium text-blue-800">Teléfono:</label>
                        <p class="text-gray-900">834 149 4966</p>
                    </div>
                    <div class="mb-2">
                        <label class="block font-medium text-blue-800">Correo:</label>
                        <p class="text-gray-900">2130074@upv.edu.mx</p>
                    </div>
                </div>
                <div class="col-span-2 flex justify-between mt-6">
                    <button type="button" style="margin-right: 16px;"
                        class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        onclick="location.href='/expediente'">
                        Ver expediente
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
