<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Detalles de la cita</title>
</head>

<body
    style="background-image: url('img/fondo.jpg'); background-size: cover; background-position: center; height: 100vh; margin: 0; padding: 0;">
    <header class="flex justify-between items-center bg-opacity-75 bg-white p-4">
        <h1 class="text-2xl font-bold text-gray-800">SaludConecta</h1>
        <div class="flex items-center">
            <button class="text-blue-500 px-4 py-2 rounded">Catálogo de productos</button>
            <div class="ml-4">
                <a href="{{ route('logout') }}"><button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cerrar sesión</button></a>
            </div>
        </div>
    </header>

  
    <div class="flex items-center justify-center h-screen" style="margin-top: -75px;">
        <div class="bg-white bg-opacity-75 p-8 rounded-lg shadow-md w-full max-w-3xl">
            <h2 class="text-3xl font-bold text-blue-600 text-center mb-4">Detalles de la cita</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-2">
                    <label class="block font-medium text-blue-600">Motivo de la cita:</label>
                    <input type="text" name="motivo" placeholder="Motivo de la cita" class="w-full px-4 py-2 border rounded-md">
                </div>
                <div class="mb-2">
                    <label class="block font-medium text-blue-600">Fecha de la cita:</label>
                    <input type="date" name="fecha" class="w-full px-4 py-2 border rounded-md">
                </div>
                <div class="mb-2">
                    <label class="block font-medium text-blue-600">Estudios a realizar:</label>
                    <input type="text" name="estudios" placeholder="Estudios a realizar" class="w-full px-4 py-2 border rounded-md">
                </div>
                <div class="mb-2">
                    <label class="block font-medium text-blue-600">Hora de la cita:</label>
                    <input type="time" name="hora" class="w-full px-4 py-2 border rounded-md">
                </div>
                <div class="mb-4 col-span-2">
                    <label class="block font-medium text-blue-600">Medicamentos recetados:</label>
                    <form id="medicationsForm">
                        <div id="medicationFields" class="space-y-2">
                            <div class="flex items-center">
                                <input type="text" name="medicamentos[]" placeholder="Medicamento" class="flex-1 px-4 py-2 border rounded-md">
                            </div>
                        </div>
                        <button type="button" onclick="addMedicationField()" class="mt-2 text-blue-500">+ Añadir más</button>
                    </form>
                </div>
            </div>
            <div class="flex justify-between mt-6">
                <button type="button" style="margin-right: 16px;"
                    class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="location.href='/expediente'">
                    Regresar al expediente
                </button>
                <button type="button" style="margin-right: 16px;"
                    class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="location.href='/doctor'">
                    Regresar al inicio
                </button>
                <button type="button"
                    class="w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Guardar
                </button>
            </div>
        </div>
    </div>

    <script>
        function addMedicationField() {
            const container = document.getElementById('medicationFields');
            const field = document.createElement('div');
            field.className = 'flex items-center mt-2';
            field.innerHTML = '<input type="text" name="medicamentos[]" placeholder="Medicamento" class="flex-1 px-4 py-2 border rounded-md">';
            container.appendChild(field);
        }
    </script>
</body>

</html>
