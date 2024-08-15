<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Servicios</title>
    @vite('resources/css/app.css')
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
                        <img src="{{ asset('img/usuario.png') }}" alt="Agregar servicio Icon" class="w-6 h-6 mr-2">
                        <a href="/docPacientes" class="text-lg">Pacientes</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="{{ asset('img/productos.png') }}" alt="Agregar paciente Icon" class="w-6 h-6 mr-2">
                        <a href="/docServicios" class="text-lg">Servicios</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="{{ asset('img/productos.png') }}"  alt="Ver pacientes Icon" class="w-6 h-6 mr-2">
                        <a href="/docProductos" class="text-lg">Productos</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="{{ asset('img/notificacion.png') }}" alt="Notifcaciones Icon" class="w-6 h-6 mr-2">
                        <a href="/notificaciones" class="text-lg">Notificaciones</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="{{ asset('img/ingresos.png') }}"  alt="Ver pacientes Icon" class="w-6 h-6 mr-2">
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

        <div class="flex items-center justify-center w-3/4 ml-auto">
            <div class="bg-white bg-opacity-10 p-8 md:p-10 rounded-lg shadow-xl w-full max-w-sm">
                <div class="my-4">
                    @session('succes')
                        <div class="alert alert-success" role="alert">
                            {{ $value }}
                        </div>
                    @endsession
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2 class="text-3xl font-bold text-white text-center mb-6">Registro de servicios</h2>
                <form action="{{ route('crearServicio.store') }}" method="POST">
                    @csrf
                    <fieldset class="mb-4">
                        <legend class="sr-only">Información del servicio</legend>
                        <div class="mb-4 flex items-center bg-white bg-opacity-20 rounded-md shadow-sm">
                            <img src="img/user.png" alt="Nombre Icon" class="w-6 h-6 ml-2">
                            <input type="text" name="nombre" id="nombre"
                                class="flex-grow px-3 py-2 bg-transparent border-none rounded-md focus:outline-none focus:ring-0 text-white placeholder-white"
                                placeholder="Nombre del servicio" required>
                        </div>
                        <div class="mb-4 flex items-center bg-white bg-opacity-20 rounded-md shadow-sm">
                            <img src="img/user.png" alt="Costo Icon" class="w-6 h-6 ml-2">
                            <input type="number" name="precio" id="precio"
                                class="flex-grow px-3 py-2 bg-transparent border-none rounded-md focus:outline-none focus:ring-0 text-white placeholder-white"
                                placeholder="Costo" required>
                        </div>
                        <div class="mb-4 flex items-center bg-white bg-opacity-20 rounded-md shadow-sm">
                            <img src="img/calendarioyhora.png" alt="calendario Icon" class="w-6 h-6 ml-2">
                            <input type="text" name="duracion" id="duracion"
                                class="flex-grow px-3 py-2 bg-transparent border-none rounded-md focus:outline-none focus:ring-0 text-white placeholder-white"
                                placeholder="Duración del servicio" required>
                        </div>
                    </fieldset>
                    <div class="flex-grow flex items-center justify-center mt-3">
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Registrar
                        </button>
                    </div>
                    <div class="flex-grow flex items-center justify-center mt-3">
                        <button type="button"
                            class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="location.href='/docServicios'">
                            Regresar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>
