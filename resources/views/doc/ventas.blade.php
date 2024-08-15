<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Ventas</title>
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
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <h2 class="text-3xl font-bold text-white text-center mb-6">Venta de productos</h2>
                <form action="{{ route('ventas.store') }}" method="POST">
                    @csrf
                    <fieldset class="mb-4">
                        <legend class="sr-only">Información de la venta</legend>
                        <div class="mb-4 flex items-center bg-white bg-opacity-20 rounded-md shadow-sm">
                            <img src="img/productos.png" alt="user Icon" class="w-6 h-6 ml-2">
                            <select name="nombre_producto" id="nombre_producto"
                                class="flex-grow px-3 py-2 bg-transparent border-none rounded-md focus:outline-none focus:ring-0 text-white placeholder-white select2"
                                required>
                                <option value="">Selecciona un producto</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}" data-costo="{{ $producto->costo }}">
                                        {{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4 flex items-center bg-white bg-opacity-20 rounded-md shadow-sm">
                            <img src="img/user.png" alt="user Icon" class="w-6 h-6 ml-2">
                            <select name="nombre_paciente" id="nombre_paciente"
                                class="flex-grow px-3 py-2 bg-transparent border-none rounded-md focus:outline-none focus:ring-0 text-white placeholder-white select2"
                                required>
                                <option value="">Selecciona un paciente</option>
                                @foreach ($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}">{{ $paciente->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4 flex items-center bg-white bg-opacity-20 rounded-md shadow-sm">
                            <img src="img/calendarioyhora.png" alt="Fecha y Hora Icon" class="w-6 h-6 ml-2">
                            <input type="datetime-local" name="fecha_hora" id="fecha_hora"
                                class="flex-grow px-3 py-2 bg-transparent border-none rounded-md focus:outline-none focus:ring-0 text-white placeholder-white"
                                value="{{ now()->format('Y-m-d\TH:i') }}" required>
                        </div>
                        <div class="mb-4 flex items-center bg-white bg-opacity-20 rounded-md shadow-sm">
                            <img src="img/productos.png" alt="user Icon" class="w-6 h-6 ml-2">
                            <input type="number" name="cantidad" id="cantidad"
                                class="flex-grow px-3 py-2 bg-transparent border-none rounded-md focus:outline-none focus:ring-0 text-white placeholder-white"
                                min="1" required>
                        </div>
                        <div class="mb-4 flex items-center bg-white bg-opacity-20 rounded-md shadow-sm">
                            <img src="img/productos.png" alt="user Icon" class="w-6 h-6 ml-2">
                            <span id="total_pago"
                                class="flex-grow px-3 py-2 bg-transparent border-none rounded-md focus:outline-none focus:ring-0 text-white placeholder-white"
                                style="cursor: default;"></span>
                        </div>
                    </fieldset>
                    <div class="flex-grow flex items-center justify-center mt-3">
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Vender
                        </button>
                    </div>
                    <div class="flex-grow flex items-center justify-center mt-3">
                        <button type="button"
                            class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            onclick="location.href='/docProductos'">
                            Regresar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productoSelect = document.getElementById('nombre_producto');
            const cantidadInput = document.getElementById('cantidad');
            const totalPagoSpan = document.getElementById('total_pago');

            const updateTotalPago = () => {
                const costo = productoSelect.options[productoSelect.selectedIndex].dataset.costo || 0;
                const cantidad = cantidadInput.value || 0;
                const totalPago = costo * cantidad;
                totalPagoSpan.textContent = totalPago.toFixed(2);
            };

            productoSelect.addEventListener('change', function() {
                const productoId = this.value;
                fetch(`/ventas/max-stock/${productoId}`)
                    .then(response => response.json())
                    .then(data => {
                        cantidadInput.max = data.maxStock;
                        cantidadInput.value = '';
                        totalPagoSpan.textContent = '0.00';
                    })
                    .catch(error => console.error('Error:', error));
            });

            cantidadInput.addEventListener('input', function() {
                const cantidad = parseInt(cantidadInput.value);
                const maxStock = parseInt(cantidadInput.max);

                if (cantidad > maxStock) {
                    alert(`No se puede registrar. Ingrese una cantidad menor o igual a ${maxStock}`);
                    cantidadInput.value = '';
                } else if (cantidad <= 0) {
                    alert('La cantidad debe ser mayor a 0');
                    cantidadInput.value = '';
                }

                updateTotalPago();
            });

            productoSelect.addEventListener('change', updateTotalPago);
        });
    </script>
</body>
</html>