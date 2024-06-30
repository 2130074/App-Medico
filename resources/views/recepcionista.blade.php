<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Bienvenida recepcionista</title>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const date = new Date();
            let currentMonth = date.getMonth();
            let currentYear = date.getFullYear();

            const months = [
                'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ];


            const occupiedHours = {
                '2024-06-24': ['08:00', '09:00'],
                '2024-06-25': ['10:00', '11:00'],
            };

            function renderCalendar(month, year) {
                const firstDay = new Date(year, month).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                const calendarBody = document.getElementById('calendar-body');
                calendarBody.innerHTML = '';

                let date = 1;
                for (let i = 0; i < 6; i++) {
                    const row = document.createElement('tr');

                    for (let j = 0; j < 7; j++) {
                        const cell = document.createElement('td');
                        cell.classList.add('border', 'p-2', 'text-center', 'cursor-pointer');

                        if (i === 0 && j < firstDay) {
                            const cellText = document.createTextNode('');
                            cell.appendChild(cellText);
                        } else if (date > daysInMonth) {
                            break;
                        } else {
                            const cellText = document.createTextNode(date);
                            cell.appendChild(cellText);
                            const fullDate =
                                `${year}-${String(month + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
                            cell.setAttribute('data-date', fullDate);

                            if (new Date(fullDate) < new Date().setHours(0, 0, 0, 0)) {
                                cell.classList.add('text-gray-400', 'cursor-not-allowed');
                            } else {
                                cell.addEventListener('click', openModal);
                            }
                            date++;
                        }

                        row.appendChild(cell);
                    }

                    calendarBody.appendChild(row);
                }

                document.getElementById('monthAndYear').innerText = `${months[month]} ${year}`;
            }

            function openModal(event) {
                const modal = document.getElementById('modal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                const selectedDate = event.target.getAttribute('data-date');
                document.getElementById('selected-date').value = selectedDate;

                const timeSelect = document.getElementById('selected-time');
                const availableHours = [
                    '08:00', '09:00', '10:00', '11:00', '12:00',
                    '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'
                ];
                timeSelect.innerHTML = '';
                availableHours.forEach(time => {
                    const option = document.createElement('option');
                    option.value = time;
                    option.text = time;

                    if (occupiedHours[selectedDate] && occupiedHours[selectedDate].includes(time)) {
                        option.disabled = true;
                    }

                    timeSelect.appendChild(option);
                });
            }

            function closeModal() {
                const modal = document.getElementById('modal');
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }

            function validateForm(event) {
                const patientName = document.getElementById('patient-name').value;
                const appointmentReason = document.getElementById('appointment-reason').value;
                const serviceType = document.getElementById('service-type').value;
                const selectedDate = document.getElementById('selected-date').value;
                const selectedTime = document.getElementById('selected-time').value;

                if (!patientName || !appointmentReason || !serviceType || !selectedDate || !selectedTime) {
                    event.preventDefault();
                    alert('Por favor, completa todos los campos.');
                    return;
                }

                if (occupiedHours[selectedDate] && occupiedHours[selectedDate].includes(selectedTime)) {
                    event.preventDefault();
                    alert('La hora seleccionada ya está ocupada.');
                }
            }

            document.getElementById('next').addEventListener('click', function() {
                currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
                currentMonth = (currentMonth + 1) % 12;
                renderCalendar(currentMonth, currentYear);
            });

            document.getElementById('prev').addEventListener('click', function() {
                currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
                currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
                renderCalendar(currentMonth, currentYear);
            });

            document.getElementById('today').addEventListener('click', function() {
                currentMonth = date.getMonth();
                currentYear = date.getFullYear();
                renderCalendar(currentMonth, currentYear);
            });

            document.getElementById('close-modal').addEventListener('click', closeModal);
            document.getElementById('register-button').addEventListener('click', validateForm);

            renderCalendar(currentMonth, currentYear);
        });

        $(document).ready(function() {
            // Llenar el select de pacientes
            $.getJSON("/api/pacientes", function(data) {
                var select = $("#patient-name");
                select.empty(); // Vacía el select antes de llenarlo
                $.each(data, function(key, val) {
                    select.append("<option value='" + key + "'>" + val + "</option>");
                });
            });

            // Llenar el select de servicios
            $.getJSON("/api/servicios", function(data) {
                var select = $("#service-type");
                select.empty(); // Vacía el select antes de llenarlo
                $.each(data, function(key, val) {
                    select.append("<option value='" + key + "'>" + val + "</option>");
                });
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
            <button
                class="w-full flex justify-center py-2 px-2 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                onclick="location.href='/'">
                Cerrar sesión
            </button>
        </div>

        <div class="flex-1 p-8 mt-24">
            <div class="bg-white shadow-md rounded-lg p-4">
                <div class="flex justify-between mb-4">
                    <button id="prev" class="text-blue-600 hover:underline mr-2">&lt;</button>
                    <h2 id="monthAndYear" class="text-xl font-bold">Enero 2022</h2>
                    <button id="next" class="text-blue-600 hover:underline mr-2">&gt;</button>
                    <button id="today" class="bg-blue-600 text-white py-1 px-3 rounded">Hoy</button>
                </div>
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="p-2">Lun</th>
                            <th class="p-2">Mar</th>
                            <th class="p-2">Mié</th>
                            <th class="p-2">Jue</th>
                            <th class="p-2">Vie</th>
                            <th class="p-2">Sáb</th>
                            <th class="p-2">Dom</th>
                        </tr>
                    </thead>
                    <tbody id="calendar-body" class="text-center">
                        <!-- Los dias se generan aqui -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-lg p-6 w-1/3 relative">
            <button id="close-modal" class="absolute top-2 right-2 text-gray-700 hover:text-gray-900">&times;</button>
            <h2 class="text-2xl font-bold mb-4">Agendar servicio</h2>
        
            @if (isset($pacientes) && isset($servicios))
                <form id="appointment-form" method="POST" action="{{ route('recepcionista.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="patient-name" class="block text-sm font-medium text-gray-700">Nombre del
                            paciente</label>
                        <select id="patient-name" name="id_paciente"
                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                            @foreach ($pacientes as $paciente)
                                <option value="{{ $paciente->id }}">{{ $paciente->nombre }} {{ $paciente->apellidos }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="appointment-reason" class="block text-sm font-medium text-gray-700">Motivo de la
                            cita</label>
                        <input type="text" id="motivos" name="motivos"
                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="service-type" class="block text-sm font-medium text-gray-700">Tipo de
                            servicio</label>
                        <select id="service-type" name="id_servicio"
                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                            @foreach ($servicios as $servicio)
                                <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="selected-date" class="block text-sm font-medium text-gray-700">Fecha</label>
                        <input type="text" id="selected-date" name="fecha"
                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="selected-time" class="block text-sm font-medium text-gray-700">Hora</label>
                        <select id="selected-time" name="hora"
                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                            <option value="08:00">08:00 AM</option>
                            <option value="09:00">09:00 AM</option>
                            <option value="10:00">10:00 AM</option>
                            <option value="11:00">11:00 AM</option>
                            <option value="12:00">12:00 PM</option>
                            <option value="13:00">01:00 PM</option>
                            <option value="14:00">02:00 PM</option>
                            <option value="15:00">03:00 PM</option>
                            <option value="16:00">04:00 PM</option>
                            <option value="17:00">05:00 PM</option>
                            <option value="18:00">06:00 PM</option>
                        </select>
                    </div>
                    <div class="flex-grow flex items-center justify-center mt-6">
                        <button type="submit" id="register-button"
                            class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Registrar
                        </button>
                    </div>
                </form>
            @else
                <p>No se encontraron pacientes o servicios.</p>
            @endif
        </div>
    </div>
</body>

</html>