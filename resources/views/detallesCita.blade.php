<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Detalles de la Cita</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        html,
        body {
            overflow: hidden;
            height: 100%;
        }

        .scrollable-content {
            overflow-y: scroll;
            height: 100%;
            scrollbar-width: thin;
            /* Para Firefox */
            scrollbar-color: white transparent;
            /* Para Firefox */
        }

        .scrollable-content::-webkit-scrollbar {
            width: 8px;
        }

        .scrollable-content::-webkit-scrollbar-track {
            background: transparent;
        }

        .scrollable-content::-webkit-scrollbar-thumb {
            background-color: white;
            border-radius: 20px;
            border: 3px solid transparent;
        }


        .flex-row {
            display: flex;
            gap: 16px;
        }

        .flex-col {
            flex: 0.56;
        }

        .custom-width {
            max-width: 750px;
        }

        .medications-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr) auto;
            gap: 8px;
            align-items: center;
        }

        .medications-row input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .medications-row button {
            padding: 8px;
            border-radius: 4px;
            color: #1e3a8a;
            cursor: pointer;
            text-align: center;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-[#4CA9DF] to-[#292E91]">
    <div class="flex h-screen overflow-hidden">
        <div
            class="bg-blue-650 text-white w-full sm:w-1/4 md:w-1/5 lg:w-1/6 p-6 flex flex-col justify-between shadow-xl">
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
                        <img src="{{ asset('img/productos.png') }}" alt="Ver pacientes Icon" class="w-6 h-6 mr-2">
                        <a href="/docProductos" class="text-lg">Productos</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="{{ asset('img/notificacion.png') }}" alt="Notifcaciones Icon" class="w-6 h-6 mr-2">
                        <a href="/notificaciones" class="text-lg">Notificaciones</a>
                    </li>
                    <li class="flex items-center mb-10">
                        <img src="{{ asset('img/ingresos.png') }}" alt="Ver pacientes Icon" class="w-6 h-6 mr-2">
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

        <main class="flex-grow overflow-y-auto">
            <div class="bg-white bg-opacity-10 p-8 md:p-10 rounded-lg shadow-xl w-full custom-width mx-auto">
                <h2 class="text-3xl font-bold text-blue-800 text-center mb-4">Detalles de la cita</h2>
                <form action="{{ route('actualizarCita', ['id' => $cita->id]) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-2">
                            <label class="block font-medium text-blue-800">Nombre:</label>
                            <input type="text" name="nombre" value="{{ $cita->paciente->nombre }}"
                                class="w-full px-4 py-2 border rounded-md" readonly>
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium text-blue-800">Apellidos:</label>
                            <input type="text" name="apellidos" value="{{ $cita->paciente->apellidos }}"
                                class="w-full px-4 py-2 border rounded-md" readonly>
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium text-blue-800">Servicio:</label>
                            <input type="text" name="motivos"
                                value="{{ $cita->tipo_servicio ? $cita->tipo_servicio->nombre : 'N/A' }}"
                                placeholder="Motivo de la cita" class="w-full px-4 py-2 border rounded-md">
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium text-blue-800">Motivo de la cita:</label>
                            <input type="text" name="motivos" value="{{ $cita->motivos }}"
                                placeholder="Motivo de la cita" class="w-full px-4 py-2 border rounded-md">
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium text-blue-800">Fecha de la cita:</label>
                            <input type="date" name="fecha" value="{{ $cita->fecha->format('Y-m-d') }}"
                                class="w-full px-4 py-2 border rounded-md">
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium text-blue-800">Hora de la cita:</label>
                            <input type="time" name="hora" value="{{ date('H:i', strtotime($cita->hora)) }}"
                                class="w-full px-4 py-2 border rounded-md">
                        </div>
                        <div class="col-span-2 flex-row">
                            <div class="flex-col mb-2">
                                <label class="block font-medium text-blue-800">Edad:</label>
                                <input type="number" name="edad" value="{{ $cita->paciente->edad }}"
                                    class="w-full px-4 py-2 border rounded-md">
                            </div>
                            <div class="flex-col mb-2">
                                <label class="block font-medium text-blue-800">Género:</label>
                                <select name="genero" class="w-full px-4 py-2 border rounded-md">
                                    <option value="Masculino"
                                        {{ $cita->paciente->genero == 'Masculino' ? 'selected' : '' }}>Masculino
                                    </option>
                                    <option value="Femenino"
                                        {{ $cita->paciente->genero == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                    <option value="Otro" {{ $cita->paciente->genero == 'Otro' ? 'selected' : '' }}>
                                        Otro</option>
                                </select>
                            </div>
                            <div class="flex-col mb-2">
                                <label class="block font-medium text-blue-800">Altura (cm):</label>
                                <input type="number" step="0.01" name="altura"
                                    value="{{ number_format($cita->paciente->altura, 2) }}"
                                    class="w-full px-4 py-2 border rounded-md">
                            </div>
                            <div class="flex-col mb-2">
                                <label class="block font-medium text-blue-800">Peso (kg):</label>
                                <input type="number" name="peso" value="{{ $cita->paciente->peso }}"
                                    class="w-full px-4 py-2 border rounded-md">
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium text-blue-800">Enfermedades:</label>
                            <input type="text" name="enfermedades" value="{{ $cita->paciente->enfermedades }}"
                                class="w-full px-4 py-2 border rounded-md">
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium text-blue-800">Alergias:</label>
                            <input type="text" name="alergias" value="{{ $cita->paciente->alergias }}"
                                class="w-full px-4 py-2 border rounded-md">
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium text-blue-800">Temperatura:</label>
                            <input type="text" name="temperatura" value="{{ $cita->temperatura }}"
                                placeholder="Temperatura" class="w-full px-4 py-2 border rounded-md">
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium text-blue-800">Presión arterial:</label>
                            <input type="text" name="presion_arterial" value="{{ $cita->presion_arterial }}"
                                placeholder="Presión arterial" class="w-full px-4 py-2 border rounded-md">
                        </div>
                        <div class="col-span-2 mb-2">
                            <label class="block font-medium text-blue-800">Diagnóstico:</label>
                            <textarea name="diagnostico" placeholder="Diagnóstico" class="w-full px-4 py-2 border rounded-md">{{ $cita->diagnostico }}</textarea>
                        </div>
                        <div class="col-span-2 mb-2">
                            <label class="block font-medium text-blue-800">Enfermera asignada:</label>
                            <select id="enfermeraSelect" name="enfermera_id"
                                class="w-full px-4 py-2 border rounded-md select2" onchange="updateTotal()">
                                <option value="">Seleccione una enfermera</option>
                                @foreach ($enfermeras as $enfermera)
                                    <option value="{{ $enfermera->id }}" data-sueldo="{{ $enfermera->sueldo }}"
                                        {{ $cita->enfermera_id == $enfermera->id ? 'selected' : '' }}>
                                        {{ $enfermera->nombre_completo }} - ${{ $enfermera->sueldo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-2 mb-2">
                            <label class="block font-medium text-blue-800">Estudios a realizar:</label>
                            <div id="estudiosFields" class="space-y-2">
                                @foreach (explode(',', $cita->estudios) as $estudio)
                                    <div class="flex items-center">
                                        <input type="text" name="estudios[]" value="{{ $estudio }}"
                                            placeholder="Estudio" class="w-full px-4 py-2 border rounded-md">
                                        <button type="button" onclick="removeField(this)"
                                            class="ml-2 text-2xl font-bold text-blue-800">-</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" onclick="addEstudioField()" class="mt-2 text-blue-800">+
                                Añadir más</button>
                        </div>

                        <div class="col-span-2 mb-2">
                            <label class="block font-medium text-blue-800">Medicamentos recetados:</label>
                            <div id="medicationFields" class="space-y-2">
                                @if (!is_null($cita->medicamentos))
                                    @php
                                        $medicamentos = json_decode($cita->medicamentos, true);
                                    @endphp
                                    @foreach ($medicamentos as $medicamento)
                                        <div class="medications-row">
                                            <input type="text" name="medicamentos[]"
                                                value="{{ $medicamento['medicamento'] }}" placeholder="Medicamento"
                                                class="w-full px-4 py-2 border rounded-md">
                                            <input type="text" name="dosis[]" value="{{ $medicamento['dosis'] }}"
                                                placeholder="Dosis" class="w-full px-4 py-2 border rounded-md">
                                            <input type="text" name="frecuencia[]"
                                                value="{{ $medicamento['frecuencia'] }}" placeholder="Frecuencia"
                                                class="w-full px-4 py-2 border rounded-md">
                                            <input type="text" name="duracion[]"
                                                value="{{ $medicamento['duracion'] }}" placeholder="Duración"
                                                class="w-full px-4 py-2 border rounded-md">
                                            <button type="button" onclick="removeField(this)"
                                                class="ml-2 text-2xl font-bold text-blue-800">-</button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" onclick="addMedicationField()" class="mt-2 text-blue-800">+ Añadir
                                más</button>
                        </div>

                        <!-- Productos usados -->
                        <div class="col-span-2 grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="block font-medium text-blue-800">Productos usados:</label>
                                <div id="productFields" class="space-y-2">
                                    @php
                                        $productosData = json_decode($cita->productos, true) ?? [];
                                    @endphp
                                    @foreach ($productosData as $producto)
                                        <div class="flex items-center mt-2">
                                            <select name="productos[]"
                                                class="w-full px-4 py-2 border rounded-md select2"
                                                onchange="updateTotal()">
                                                <option value="">Selecciona un producto</option>
                                                @foreach ($productos as $item)
                                                    <option value="{{ $item->id }}"
                                                        data-precio="{{ $item->costo }}"
                                                        {{ $producto['id'] == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nombre }} - ${{ $item->costo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="number" name="cantidades[]"
                                                value="{{ $producto['cantidad'] }}" placeholder="Cantidad"
                                                class="w-full px-4 py-2 border rounded-md ml-2" min="1"
                                                onchange="updateTotal()">
                                            <button type="button" onclick="removeField(this)"
                                                class="ml-2 text-2xl font-bold text-blue-800">-</button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" onclick="addProductField()" class="mt-2 text-blue-800">+
                                    Añadir más</button>
                            </div>

                            <input type="hidden" id="priceOfNurse" name="priceOfNurse">


                            <div class="mb-2">
                                <label class="block font-medium text-blue-800">Precio del servicio:</label>
                                <input type="text" id="servicePrice"
                                    value="{{ $servicio ? $servicio->precio : 0 }}"
                                    class="w-full px-4 py-2 border rounded-md" readonly>
                            </div>
                            <div class="mb-2">
                                <label class="block font-medium text-blue-800">Total:</label>
                                <input type="text" id="total" name="total" value="{{ $cita->total }}"
                                    class="w-full px-4 py-2 border rounded-md" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between mt-6">
                        <button type="button" style="margin-right: 16px;"
                            class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            onclick="location.href='/expediente/{{ $cita->id_paciente }}'">
                            Expediente
                        </button>
                        <button type="button" style="margin-right: 16px;"
                            class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            onclick="location.href='/docPacientes'">
                            Pacientes
                        </button>
                        <button type="button" style="margin-right: 16px;"
                            class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            onclick="window.location.href='{{ route('generate.pdf', ['id' => $cita->id]) }}'">
                            Descargar
                        </button>
                        <button type="button" id="pedirOpinionBtn" style="margin-right: 16px;" class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Pedir opinión
                        </button>
                        <button type="submit"
                            class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
            <div id="opinionModal"
                class="fixed inset-0 z-50 bg-gray-600 bg-opacity-50 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md">
                    <div class="text-center">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Pedir una Opinión</h3>
                        <p class="text-sm text-gray-500 mb-4">¿A qué doctor deseas pedir una opinión?</p>
                        <form action="{{ route('enviar.opinion') }}" method="POST">
                            @csrf
                            <input type="hidden" name="cita_id" value="{{ $cita->id }}">
                            <select id="doctorSelect" name="doctor_id" class="select2 w-full mb-4 p-2 text-base border rounded-md">
                                @foreach ($doctores as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->nombre_completo }}</option>
                                @endforeach
                            </select>                            

                            <!-- Textarea para escribir el mensaje -->
                            <textarea name="mensaje" class="w-full p-2 border border-gray-300 rounded-md mb-4"
                                placeholder="Escribe tu mensaje..."></textarea>

                            <!-- Botones -->
                            <div class="flex justify-between mt-4">
                                <button type="button" id="closeModal"
                                    class="w-1/3 bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-400">Cerrar</button>
                                <button type="submit"
                                    class="w-1/3 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-400">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    <script>
        function addMedicationField() {
            var container = document.getElementById('medicationFields');
            var div = document.createElement('div');
            div.className = 'medications-row mt-2';
            div.innerHTML = `
        <input type="text" name="medicamentos[]" placeholder="Medicamento" class="w-full px-4 py-2 border rounded-md">
        <input type="text" name="dosis[]" placeholder="Dosis" class="w-full px-4 py-2 border rounded-md">
        <input type="text" name="frecuencia[]" placeholder="Frecuencia" class="w-full px-4 py-2 border rounded-md">
        <input type="text" name="duracion[]" placeholder="Duración" class="w-full px-4 py-2 border rounded-md">
        <button type="button" onclick="removeField(this)" class="ml-2 text-2xl font-bold text-blue-800">-</button>
    `;
            container.appendChild(div);
        }

        function addEstudioField() {
            var container = document.getElementById('estudiosFields');
            var div = document.createElement('div');
            div.className = 'flex items-center mt-2';
            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'estudios[]';
            input.placeholder = 'Estudio';
            input.className = 'w-full px-4 py-2 border rounded-md';
            var button = document.createElement('button');
            button.type = 'button';
            button.className = 'ml-2 text-2xl font-bold text-blue-800';
            button.textContent = '-';
            button.onclick = function() {
                removeField(button);
            };
            div.appendChild(input);
            div.appendChild(button);
            container.appendChild(div);
        }

        function addProductField() {
            var container = document.getElementById('productFields');
            var div = document.createElement('div');
            div.className = 'flex items-center mt-2';

            var select = document.createElement('select');
            select.name = 'productos[]';
            select.className = 'w-full px-4 py-2 border rounded-md';
            select.setAttribute('onchange', 'updateTotal(this)');
            var option = document.createElement('option');
            option.value = '';
            option.text = 'Selecciona un producto';
            select.appendChild(option);

            @foreach ($productos as $producto)
                var option = document.createElement('option');
                option.value = '{{ $producto->id }}';
                option.text = '{{ $producto->nombre }} - {{ $producto->costo }}';
                option.setAttribute('data-precio', '{{ $producto->costo }}');
                select.appendChild(option);
            @endforeach

            var input = document.createElement('input');
            input.type = 'number';
            input.name = 'cantidades[]';
            input.placeholder = 'Cantidad';
            input.className = 'w-full px-4 py-2 border rounded-md ml-2';
            input.setAttribute('min', 1);
            input.setAttribute('onchange', 'updateTotal()');

            var button = document.createElement('button');
            button.type = 'button';
            button.className = 'ml-2 text-2xl font-bold text-blue-800';
            button.textContent = '-';
            button.onclick = function() {
                removeField(button);
            };

            div.appendChild(select);
            div.appendChild(input);
            div.appendChild(button);
            container.appendChild(div);
        }

        function removeField(button) {
            const field = button.parentNode;
            field.parentNode.removeChild(field);
            updateTotal();
        }

        function updateQuantityOptions(select) {
            const selectedOption = select.options[select.selectedIndex];
            const stock = selectedOption.getAttribute('data-stock');
            const quantityInput = select.nextElementSibling;

            quantityInput.setAttribute('max', stock);
            quantityInput.setAttribute('min', 1);
            quantityInput.value = 1;

            updateTotal();
        }

        function validateQuantity(input) {
            const max = input.getAttribute('max');
            const min = input.getAttribute('min');
            if (parseInt(input.value) > parseInt(max)) {
                input.value = max;
            } else if (parseInt(input.value) < parseInt(min)) {
                input.value = min;
            }
            updateTotal();
        }

        function updateTotal() {
            const productFields = document.querySelectorAll('#productFields > div');
            let total = 0;

            productFields.forEach(field => {
                const selectElement = field.querySelector('select');
                const price = parseFloat(selectElement.options[selectElement.selectedIndex].dataset.precio || 0);
                const quantity = parseFloat(field.querySelector('input').value || 0);
                total += price * quantity;
            });

            const servicePrice = parseFloat(document.getElementById('servicePrice').value || 0);
            total += servicePrice;

            const selectedEnfermera = document.getElementById('enfermeraSelect');
            const enfermeraSueldo = parseFloat(selectedEnfermera.options[selectedEnfermera.selectedIndex].dataset.sueldo ||
                0);
            total += enfermeraSueldo;

            document.getElementById('total').value = total.toFixed(2);
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateTotal();
            document.querySelectorAll('input[name="cantidades[]"], select[name="productos[]"]').forEach(function(
                element) {
                element.addEventListener('input', updateTotal);
                element.addEventListener('change', updateTotal);
            });
        });

        $(document).ready(function() {
            $('.select2').select2();

            $('#opinionModal').addClass('hidden');

            $('#pedirOpinionBtn').on('click', function() {
                $('#opinionModal').removeClass('hidden');
            });

            $('#closeModal').on('click', function() {
                $('#opinionModal').addClass('hidden');
            });
        });
    </script>
</body>

</html>
