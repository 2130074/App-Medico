<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                        <img src="{{ asset('img/calendario.png') }}" alt="Agenda Icon" class="w-6 h-6 mr-2">
                        <a href="/doctor" class="text-lg">Agenda</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="{{ asset('img/usuario.png') }}" alt="Pacientes Icon" class="w-6 h-6 mr-2">
                        <a href="/docPacientes" class="text-lg">Pacientes</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="{{ asset('img/productos.png') }}" alt="Servicios Icon" class="w-6 h-6 mr-2">
                        <a href="/docServicios" class="text-lg">Servicios</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="{{ asset('img/productos.png') }}" alt="Productos Icon" class="w-6 h-6 mr-2">
                        <a href="/docProductos" class="text-lg">Productos</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="{{ asset('img/notificacion.png') }}" alt="Notifcaciones Icon" class="w-6 h-6 mr-2">
                        <a href="/notificaciones" class="text-lg">Notificaciones</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="{{ asset('img/ingresos.png') }}" alt="Ingresos Icon" class="w-6 h-6 mr-2">
                        <a href="/docIngresos" class="text-lg">Ingresos</a>
                    </li>
                </ul>
            </div>
            <button
                class="w-full flex justify-center py-2 px-2 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                onclick="location.href='/'">
                Cerrar sesión
            </button>
        </div>

        <div class="flex-1 p-6 overflow-y-auto">
            <h1 class="text-4xl font-bold text-white mb-8">Respuestas a Notificaciones</h1>

            <!-- doc/notificaciones.blade.php -->
            @if ($notificaciones->isEmpty())
                <p class="text-white text-lg">No hay respuestas a notificaciones disponibles.</p>
            @else
                <div class="space-y-6">
                    @foreach ($notificaciones as $notificacion)
                        @if ($notificacion->replies->isNotEmpty())
                            <div
                                class="p-4 bg-white border rounded-lg shadow hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1">
                                <p class="text-lg">{{ $notificacion->message }}</p>
                                <p class="text-sm text-gray-500 mt-2">
                                    {{ $notificacion->created_at->format('d/m/Y H:i') }}</p>
                                @if ($notificacion->pdf_path)
                                    <a href="{{ $notificacion->pdf_path }}" target="_blank"
                                        class="text-blue-500 hover:underline mt-2 block">Ver PDF</a>
                                @endif

                                <!-- Mostrar respuestas -->
                                <div class="mt-4">
                                    <h3 class="text-xl font-semibold">Respuestas:</h3>
                                    @foreach ($notificacion->replies as $reply)
                                        <div class="bg-gray-100 p-4 mt-2 rounded">
                                            <p>{{ $reply->message }}</p>
                                            <p class="text-sm text-gray-500">Enviado a las {{ $reply->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</body>

</html>
