<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FullCalendar CSS and JS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>
    <title>Bienvenida recepcionista</title>
    <style>
        #calendar {
            background-color: white;
            max-width: 100%;
            margin: 0 auto;
        }

        #modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        #modal .modal-content {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1rem;
            width: 90%;
            max-width: 500px;
            max-height: 90%;
            overflow-y: auto;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-[#4CA9DF] to-[#292E91]">
    <div class="flex h-screen overflow-hidden">
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
        <!-- Calendario -->
        <div class="w-4/5 p-6 overflow-auto">
            <div id='calendar'></div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="modal-content bg-white rounded-lg p-6 w-1/3 relative">
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
                            <option value="08:30">08:30 AM</option>
                            <option value="09:00">09:00 AM</option>
                            <option value="09:30">09:30 AM</option>
                            <option value="10:00">10:00 AM</option>
                            <option value="10:30">10:30 AM</option>
                            <option value="11:00">11:00 AM</option>
                            <option value="11:30">11:30 AM</option>
                            <option value="12:00">12:00 PM</option>
                            <option value="12:30">12:30 PM</option>
                            <option value="13:00">01:00 PM</option>
                            <option value="13:30">01:30 PM</option>
                            <option value="14:00">02:00 PM</option>
                            <option value="14:30">02:30 PM</option>
                            <option value="15:00">03:00 PM</option>
                            <option value="15:30">03:30 PM</option>
                            <option value="16:00">04:00 PM</option>
                            <option value="16:30">04:30 PM</option>
                            <option value="17:00">05:00 PM</option>
                            <option value="17:30">05:30 PM</option>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialDate: '2023-01-12',
                initialView: 'timeGridWeek',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                height: 'auto',
                navLinks: true,
                editable: true,
                selectable: true,
                selectMirror: true,
                nowIndicator: true,
                slotDuration: '00:30:00',
                slotLabelInterval: '00:30',
                views: {
                    timeGrid: {
                        slotDuration: '00:30:00',
                        slotLabelInterval: '00:30'
                    }
                },
                events: [
                    @foreach ($citas as $cita)
                        {
                            title: '{{ $cita->servicio->nombre }}',
                            start: '{{ $cita->fecha->format('Y-m-d') }}T{{ $cita->hora->format('H:i:s') }}',
                            end: '{{ $cita->fecha->format('Y-m-d') }}T{{ $cita->hora->addMinutes(30)->format('H:i:s') }}',
                            backgroundColor: '#007bff',
                            borderColor: '#0056b3',
                            textColor: '#ffffff',
                        },
                    @endforeach
                ],
                dateClick: function(info) {
                    var today = new Date();
                    var selectedDate = new Date(info.dateStr);

                    if (selectedDate < today.setHours(0, 0, 0, 0)) {
                        alert('No puedes seleccionar fechas pasadas.');
                        return; 
                    }

                    var modal = document.getElementById('modal');
                    modal.style.display = 'flex';

                    var selectedDateField = document.getElementById('selected-date');
                    selectedDateField.value = info.dateStr;

                    var selectedDateStr = info.dateStr;
                    var now = new Date();
                    var selectedDateObj = new Date(selectedDateStr);
                }
            });

            calendar.render();

            // Cerrar el modal
            var closeModalBtn = document.getElementById('close-modal');
            closeModalBtn.addEventListener('click', function() {
                var modal = document.getElementById('modal');
                modal.style.display = 'none';
            });
        });
    </script>
</body>

</html>
