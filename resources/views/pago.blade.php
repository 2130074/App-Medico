<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Ver Pagos</title>
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
                        <img src="{{ asset('img/calendario.png') }}"  alt="Agenda Icon" class="w-6 h-6 mr-2">
                        <a href="/recepcionista" class="text-lg">Agenda</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="{{ asset('img/calendario.png') }}" alt="Agregar servicio Icon" class="w-6 h-6 mr-2">
                        <a href="/servicios" class="text-lg">Agregar servicio</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="{{ asset('img/calendario.png') }}" alt="Agregar paciente Icon" class="w-6 h-6 mr-2">
                        <a href="/registroPacientes" class="text-lg">Agregar paciente</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="{{ asset('img/calendario.png') }}" alt="Agregar paciente Icon" class="w-6 h-6 mr-2">
                        <a href="/registrarProducto" class="text-lg">Agregar producto</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="{{ asset('img/usuario.png') }}" alt="Ver pacientes Icon" class="w-6 h-6 mr-2">
                        <a href="/verServicios" class="text-lg">Ver servicios</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="{{ asset('img/usuario.png') }}" alt="Ver pacientes Icon" class="w-6 h-6 mr-2">
                        <a href="/verPacientes" class="text-lg">Ver pacientes</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="{{ asset('img/usuario.png') }}" alt="Ver pacientes Icon" class="w-6 h-6 mr-2">
                        <a href="/Productos" class="text-lg">Ver productos</a>
                    </li>
                </ul>
            </div>
            <button
                class="w-full flex justify-center py-2 px-2 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                onclick="location.href='/'">
                Cerrar sesión
            </button>
        </div>

        <div class="flex-1 flex flex-col p-6">
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

            <div class="overflow-x-auto mt-6">
                <table class="min-w-full bg-white bg-opacity-10 rounded-lg shadow-xl text-white">
                    <thead>
                        <tr class="bg-blue-500">
                            <th class="py-2 px-4 text-left">Servicio</th>
                            <th class="py-2 px-4 text-center">Costo</th>
                            <th class="py-2 px-4 text-center">Fecha</th>
                            <th class="py-2 px-4 text-center">Estado</th>
                            <th class="py-2 px-4 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($citas as $cita)
                            <tr class="hover:bg-blue-600">
                                <td class="py-2 px-4">{{ $cita->tipo_servicio->nombre }}</td>
                                <td class="py-2 px-4 text-center">${{ $cita->total}}</td>
                                <td class="py-2 px-4 text-center">{{ $cita->fecha->format('d/m/Y') }}</td>
                                <td class="py-2 px-4 text-center">
                                    @if ($cita->estado == 'Pendiente')
                                        <span class="text-yellow-500 font-bold">Pendiente</span>
                                    @else
                                        <span class="text-green-500 font-bold">Pagado</span>
                                    @endif
                                </td>
                                <td class="py-2 px-4 text-center">
                                    <form action="{{ route('cambiarEstadoPago', $cita->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="paciente_id" value="{{ $id }}">
                                        @if ($cita->estado == 'Pendiente')
                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                                                Marcar como Pagado
                                            </button>
                                        @else
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                                                Marcar como Pendiente
                                            </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end mt-6">
                <h3 class="text-xl font-bold text-gray-800">Total: <span class="text-blue-500">
                    ${{ $citas->where('estado', 'Pendiente')->sum(fn($cita) => $cita->tipo_servicio->precio) }}
                </span></h3>
            </div>

            <div class="flex justify-end mt-6">
                <button type="button"
                    class="flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    onclick="location.href='{{ route('verPacientes') }}'">
                    Regresar
                </button>
            </div>
        </div>
    </div>
</body>

</html>
