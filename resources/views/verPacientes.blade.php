<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Ver Pacientes</title>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var inputSearch = document.querySelector(
                '.search-input');
            var tbody = document.querySelector('tbody');

            inputSearch.addEventListener('input', function(e) {
                var filterValue = e.target.value.toLowerCase();
                var rows = tbody.getElementsByTagName('tr');

                for (var i = 0; i < rows.length; i++) {
                    var row = rows[i];
                    var match = false;

                    var cells = row.getElementsByTagName('td');
                    for (var j = 0; j < cells.length && !match; j++) {
                        var cellText = cells[j].textContent || cells[j].innerText;
                        match |= cellText.toLowerCase().indexOf(filterValue) !== -1;
                    }

                    if (match) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
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
                    <img src="img/logo.png" alt="Logo" class="w-8 h-8 mr-2">
                    <span class="text-2xl font-bold">Salud Conecta</span>
                </div>
                <ul>
                    <li class="flex items-center mb-10">
                        <img src="img/calendario.png" alt="Agenda Icon" class="w-6 h-6 mr-2">
                        <a href="/recepcionista" class="text-lg">Agenda</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="img/calendario.png" alt="Agregar servicio Icon" class="w-6 h-6 mr-2">
                        <a href="/servicios" class="text-lg">Agregar servicio</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="img/calendario.png" alt="Agregar paciente Icon" class="w-6 h-6 mr-2">
                        <a href="/registroPacientes" class="text-lg">Agregar paciente</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="img/usuario.png" alt="Ver pacientes Icon" class="w-6 h-6 mr-2">
                        <a href="/verServicios" class="text-lg">Ver servicios</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="img/usuario.png" alt="Ver pacientes Icon" class="w-6 h-6 mr-2">
                        <a href="/verPacientes" class="text-lg">Ver pacientes</a>
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
                        class="w-full py-2 pl-4 pr-10 border border-blue-500 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 search-input">
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
                            <th class="py-2 px-4 text-left">Nombre</th>
                            <th class="py-2 px-4 text-left">Correo</th>
                            <th class="py-2 px-4 text-center">Última cita</th>
                            <th class="py-2 px-4 text-center">Próxima cita</th>
                            <th class="py-2 px-4 text-center">Total de pago</th>
                            <th class="py-2 px-4 text-center">Modificar</th>
                            <th class="py-2 px-4 text-center">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($pacientes))
                            @foreach ($pacientes as $paciente)
                                <tr class="hover:bg-blue-600">
                                    <td class="py-2 px-4">{{ $paciente->nombre }}</td>
                                    <td class="py-2 px-4">{{ $paciente->correo }}</td>
                                    <td class="py-2 px-4 text-center">12/08/2023</td>
                                    <td class="py-2 px-4 text-center">20/05/2024</td>
                                    <td class="py-2 px-4 text-center">
                                        <button
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                                            onclick="location.href='{{ route('verPago', $paciente->id) }}'">Ver
                                            pago</button>
                                    </td>
                                                                    
                                    <td class="py-2 px-4 text-center">
                                        <button
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                                            onclick="location.href='{{ route('pacientes.edit', $paciente->id) }}'">Modificar</button>
                                    </td>                                    

                                    <td class="py-2 px-4 text-center">
                                        <form action="{{ route('verPacientes.destroy', $paciente->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
