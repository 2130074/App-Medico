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
                        <a href="/doctor" class="text-lg">Agenda</a>
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
                <h2 class="text-3xl font-bold text-blue-800 text-center mb-4">Detalles de la cita</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block font-medium text-blue-800">Motivo de la cita:</label>
                        <input type="text" name="motivo" placeholder="Motivo de la cita"
                            class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div class="mb-2">
                        <label class="block font-medium text-blue-800">Fecha de la cita:</label>
                        <input type="date" name="fecha" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div class="mb-2">
                        <label class="block font-medium text-blue-800">Estudios a realizar:</label>
                        <input type="text" name="estudios" placeholder="Estudios a realizar"
                            class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div class="mb-2">
                        <label class="block font-medium text-blue-800">Hora de la cita:</label>
                        <input type="time" name="hora" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div class="mb-4 col-span-2">
                        <label class="block font-medium text-blue-800">Medicamentos recetados:</label>
                        <form id="medicationsForm">
                            <div id="medicationFields" class="space-y-2">
                                <div class="flex items-center">
                                    <input type="text" name="medicamentos[]" placeholder="Medicamento"
                                        class="flex-1 px-4 py-2 border rounded-md">
                                </div>
                            </div>
                            <button type="button" onclick="addMedicationField()" class="mt-2 text-blue-800">+ Añadir
                                más</button>
                        </form>
                    </div>
                </div>
                <div class="flex justify-between mt-6">
                    <button type="button" style="margin-right: 16px;"
                        class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        onclick="location.href='/expediente'">
                        Regresar al expediente
                    </button>
                    <button type="button" style="margin-right: 16px;"
                        class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        onclick="location.href='/docPacientes'">
                        Regresar al inicio
                    </button>
                    <button type="button"
                        class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addMedicationField() {
            const container = document.getElementById('medicationFields');
            const field = document.createElement('div');
            field.className = 'flex items-center mt-2';
            field.innerHTML =
                '<input type="text" name="medicamentos[]" placeholder="Medicamento" class="flex-1 px-4 py-2 border rounded-md">';
            container.appendChild(field);
        }
    </script>

</body>

</html>
