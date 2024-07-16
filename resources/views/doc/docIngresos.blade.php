<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Ingresos Diarios</title>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var inputSearch = document.querySelector('.search-input');
            var tbody = document.querySelector('tbody');

            inputSearch.addEventListener('change', function (e) {
                var selectedDate = e.target.value.trim();

                var rows = tbody.getElementsByTagName('tr');

                for (var i = 0; i < rows.length; i++) {
                    var row = rows[i];

                    var dateCell = row.querySelector('.fecha-dia');
                    if (dateCell) {
                        var rowDate = dateCell.textContent.trim();
                        if (rowDate === selectedDate) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                }
            });
        });
    </script>
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

        <div class="flex-1 flex flex-col p-6">
            <div class="flex justify-center mt-6">
                <div class="relative w-2/3 max-w-2xl">
                    <input type="date" placeholder="Buscar por fecha"
                        class="w-full py-2 pl-4 pr-10 border border-blue-500 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 search-input">
                    <svg class="absolute right-3 top-2.5 w-5 h-5 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M16.44 11.2a5.45 5.45 0 11-10.89 0 5.45 5.45 0 0110.89 0z" />
                    </svg>
                </div>
            </div>

            <div class="overflow-x-auto mt-6">
                <div class="bg-white bg-opacity-10 rounded-lg shadow-xl text-white p-4">
                    <h2 class="text-2xl font-bold text-white">Total General de Ingresos</h2>
                    <p class="text-xl">{{ $totalGeneral }}</p>
                </div>
                
                @foreach ($ingresos as $fecha => $data)
                    <h2 class="text-2xl font-bold text-white mb-4 mt-6">{{ $fecha }}</h2>
                    <table class="min-w-full bg-white bg-opacity-10 rounded-lg shadow-xl text-white mb-6">
                        <thead>
                            <tr class="bg-blue-500">
                                <th class="py-2 px-4 text-left">Cliente</th>
                                <th class="py-2 px-4 text-left">Venta del servicio independiente</th>
                                <th class="py-2 px-4 text-left">Venta de la cita</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['ventas'] as $venta)
                                <tr class="hover:bg-blue-600">
                                    <td class="py-2 px-4 fecha-dia" style="display:none;">{{ $fecha }}</td>
                                    <td class="py-2 px-4">{{ $venta->paciente->nombre }}</td>
                                    <td class="py-2 px-4">{{ $venta->total_pago }}</td>
                                    <td class="py-2 px-4">-</td>
                                </tr>
                            @endforeach
                            @foreach ($data['citas'] as $cita)
                                <tr class="hover:bg-blue-600">
                                    <td class="py-2 px-4 fecha-dia" style="display:none;">{{ $fecha }}</td>
                                    <td class="py-2 px-4">{{ $cita->paciente->nombre }}</td>
                                    <td class="py-2 px-4">-</td>
                                    <td class="py-2 px-4">{{ $cita->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-blue-500">
                                <td class="py-2 px-4 font-bold" colspan="2">Total del Día</td>
                                <td class="py-2 px-4 font-bold">{{ $data['totalDia'] }}</td>
                            </tr>
                        </tfoot>
                    </table>
                @endforeach
                
            </div>
        </div>
    </div>
</body>

</html>
