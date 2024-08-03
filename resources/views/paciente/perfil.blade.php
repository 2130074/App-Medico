<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Perfil del Paciente</title>
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
                        <img src="img/usuario.png" alt="Agregar servicio Icon" class="w-6 h-6 mr-2">
                        <a href="/perfil" class="text-lg">Mi información</a>
                    </li>
                </ul>
            </div>
            <button
                class="w-full flex justify-center py-2 px-2 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                onclick="location.href='/'">
                Regresar
            </button>
        </div>

        <!-- Main Content -->
        <div class="flex-grow p-10">
            <div class="bg-white bg-opacity-10 text-white p-8 rounded-lg shadow-lg mb-6">
                <h2 class="text-3xl font-bold text-white text-center mb-4">Detalles del paciente</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p><span class="font-semibold">Nombre(s):</span> {{ $paciente->nombre }}</p>
                        <p><span class="font-semibold">Edad:</span> {{ $paciente->edad }}</p>
                        <p><span class="font-semibold">Altura:</span> {{ $paciente->altura }}</p>
                        <p><span class="font-semibold">Enfermedades que padece:</span> {{ $paciente->enfermedades ?: 'N/A' }}</p>
                        <p><span class="font-semibold">Teléfono:</span> {{ $paciente->telefono }}</p>
                    </div>
                    <div>
                        <p><span class="font-semibold">Apellido(s):</span> {{ $paciente->apellidos }}</p>
                        <p><span class="font-semibold">Género:</span> {{ $paciente->genero }}</p>
                        <p><span class="font-semibold">Peso:</span> {{ $paciente->peso }}</p>
                        <p><span class="font-semibold">Alergias:</span> {{ $paciente->alergias ?: 'N/A' }}</p>
                        <p><span class="font-semibold">Correo:</span> {{ $paciente->correo }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white bg-opacity-10 text-white p-8 rounded-lg shadow-lg">
                <h2 class="text-3xl font-bold text-white text-center mb-4">Expediente Médico</h2>
                <table class="min-w-full bg-white bg-opacity-10 rounded-lg shadow-xl text-white">
                    <thead>
                        <tr class="bg-blue-500">
                            <th class="py-2 px-4 text-center">Fecha y hora de la cita</th>
                            <th class="py-2 px-4 text-center">Más detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($citas->isNotEmpty())
                            @foreach($citas as $cita)
                                <tr class="hover:bg-blue-600">
                                    <td class="py-2 px-4 text-center">{{ $cita->hora }}</td> 
                                    <td class="py-2 px-4 text-center">
                                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                            Descargar información
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="py-2 px-4 text-center">No hay citas disponibles</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
